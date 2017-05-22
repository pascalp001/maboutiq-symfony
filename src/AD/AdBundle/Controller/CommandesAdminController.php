<?php

namespace AD\AdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use DV\EcomBundle\Entity\Commandes;
use AD\AdBundle\Form\CommandesType;

/**
 * Commandes controller.
 *
 */
class CommandesAdminController extends Controller
{

    /**
     * Lists all Commandes entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $stock = array();

        // Détermination de preparer en cas de stockvirtuel négatif, pour les commandes concernées :
        // . preparer=-1 si la commande possède le produit concerné (orange)
        // . preparer=-2 si la commande est la dernière en date concernée (rouge) : il faut prévenir le client ou faire un réassort urgent
        $Commandes = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 0, 'payer'=>1, 'preparer'=>0),array('date'=>'desc'));
        foreach ($Commandes as $Commande) 
        {   
            // Extraction des produits et quantités de la commande, cumul des quantités :            
            $commande = $Commande->getCommande();
            $produits = $commande['produit'];
            foreach($produits as $id => $produit)
            {               
                $produitB =  $em->getRepository('EcomBundle:Produits')->find($id);
                $stockvirtuel = $produitB->getStockvirtuel();               
                $stockreel = $produitB->getStockreel();
                if(!array_key_exists($id, $stock)){ $stock[$id] = max(0, - $stockvirtuel);}
                $qtePanier = $produit['quantite'];

                if( $stockvirtuel <0){
                    $Commande->setPreparer(-1);
                    
                    if( $stock[$id] > 0){
                        $Commande->setPreparer(-2);
                        $stock[$id] = max(0,$stock[$id] - $qtePanier);
                    }
                } 
            } 
            $em->persist($Commande);               
        }
        $em->flush();  

        // Affichage des commandes non archivées :
        $entities = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 0),array('date'=>'asc'));  
        $archive = "en cours";        

        return $this->render('AdBundle:Administration:Commandes/layout/index.html.twig', array(
            'entities' => $entities, 'archive' => $archive
        ));
    }

    
    public function nbCmdesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commandes = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 0));  
        $nbCmdesEnCours = count($commandes);
        $commandes = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 0, 'payer' => 1, 'preparer'=>0));  
        $nbNvellesCmdes = count($commandes);

        return $this->render('AdBundle:Administration:Commandes/modulesUsed/nbCmdes.html.twig', array(
            'nbCmdesEnCours' => $nbCmdesEnCours, 'nbNvellesCmdes'=> $nbNvellesCmdes
        ));
    }


    public function archiveAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 1),array('date'=>'asc'));  
        $archive = " archivées";

        return $this->render('AdBundle:Administration:Commandes/layout/index.html.twig', array(
            'entities' => $entities, 'archive' => $archive
        ));
    }

    public function modifAction($id, Request $request)
    {

        if($request->getMethod() == "POST") 
        {   
            $em = $this->getDoctrine()->getManager();
            $Commande = $em->getRepository('EcomBundle:Commandes')->find($id);
            if (!$Commande) {
               throw $this->createNotFoundException('Unable to find Commandes'.$id.' entity.');
            }            
            $Vendeur = $em->getRepository('AdBundle:Vendeur')->find('1');
            $logo1 = $Vendeur->getUrllogo1();
            $vendeur = $Vendeur->getNomcomplet();

            $avoir = array(); $stock = array();

            $payeId    = $request->request->get('paye')   ; 
            $prepareId = $request->request->get('prepare'); 
            $livreId   = $request->request->get('livre')  ;
            $archiveId = $request->request->get('archive');
            $supprId   = $request->request->get('suppr')  ;

    // PAYER/PAYÉ La commande est maintenant payée :
            if ($payeId[$id]) $Commande->setPayer ('1')   ;

    // PRÉPARER/PRÉPARÉ La commande est préparée ou en cours de préparation :
            // 1er cas : On a toutes les marchandises :
            if ($prepareId[$id] && ($Commande->getPreparer() == 0 || $Commande->getPreparer() == -1  ))  
            {                
                $Commande->setPreparer('1') ; // Le colis est préparé
                $commande = $Commande->getCommande();
                $produits = $commande['produit'];
                foreach($produits as $idp => $produit)
                {               
                    $produitB =  $em->getRepository('EcomBundle:Produits')->find($idp);              
                    $stockreel = $produitB->getStockreel();
                    $qtePanier = $produit['quantite'];
                    $stockreel = $stockreel - $qtePanier;
                    $produitB->setStockreel($stockreel);
                    $em->persist($produitB); 
                }           
                $em->persist($Commande);
            
                $em->flush();  
            } 
            // 2ème cas : On n'a pas toutes les marchandises pour cette commande :
            if ($prepareId[$id] && $Commande->getPreparer() == -2)  
            {              
                // On fait appel à la fonction stockAvoir() qui génère un tableau contenant id produits et quantités concernées,
                // et qui corrige les stocks virtuels des quantités annulées dans l'avoir :
                $res = $this->stockAvoir($Commande);
                if(is_array($res)) $avoir[$id] = $res;
                $Commande->setPreparer('2') ; // Un mail est envoyé au client et le colis est mis en réserve 48heures
                //var_dump($avoir[$id]);

                // On génère l'avoir comme une nouvelle commande :
                $Avoir = $this->genereAvoirPart($Commande, $avoir,$id);
                
                $em->persist($Avoir);

                //On corrige le statut des autres commandes mises en preparer = -2 :
                $CommandesP2 = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 0, 'payer'=>1, 'preparer'=>-2),array('date'=>'desc'));
                foreach ($CommandesP2 as $Commande) 
                {   
                    // Extraction des produits et quantités de la commande, cumul des quantités :            
                    $commande = $Commande->getCommande();
                    $produits = $commande['produit'];
                    foreach($produits as $id2 => $produit)
                    {               
                        $produitB =  $em->getRepository('EcomBundle:Produits')->find($id2);
                        $stockvirtuel = $produitB->getStockvirtuel();   
                        if(!array_key_exists($id2, $stock)){ $stock[$id2] = max(0, - $stockvirtuel);}
                        $qtePanier = $produit['quantite'];

                        if( $stockvirtuel <0){
                            $Commande->setPreparer(-1);
                            
                            if( $stock[$id2] > 0){
                                $Commande->setPreparer(-2);
                                $stock[$id2] = max(0,$stock[$id2] - $qtePanier);
                            }
                        } 
                    } 
                    $em->persist($Commande);               
                }
                //On corrige ensuite le statut des autres commandes mises en preparer = -1 :
                $CommandesP1 = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 0, 'payer'=>1, 'preparer'=>-1),array('date'=>'desc'));
                foreach ($CommandesP1 as $Commande) 
                {   
                    // Extraction des produits et quantités de la commande, cumul des quantités :            
                    $commande = $Commande->getCommande();
                    $produits = $commande['produit'];
                    foreach($produits as $id1 => $produit)
                    {               
                        $produitB =  $em->getRepository('EcomBundle:Produits')->find($id1);
                        $stockvirtuel = $produitB->getStockvirtuel();   
                        if(!array_key_exists($id1, $stock)){ $stock[$id1] = max(0, - $stockvirtuel);}
                        $qtePanier = $produit['quantite'];

                        if( $stockvirtuel == 0){
                            $Commande->setPreparer(0);
                            
                        } 
                    } 
                    $em->persist($Commande);               
                } 

                $em->flush();  
            }     

    // LIVRER/LIVRÉ La commande est partie en livraison :
            if ($livreId[$id])     $Commande->setLivrer ('1')  ;

    // ARCHIVER/ARCHIVÉ La commande est mise en archive :
            if ($archiveId[$id])   $Commande->setArchiver('1') ;

            if ($Commande) {$em->persist($Commande);}

    // SUPPRIMER/SUPPRIMÉ La commande est interrompue par le client et non validée, ou rétractation du client :
            if ($supprId[$id]) {
                // La commande doit être ou non annulée, les stocks doivent être remis en état :
                // 1 - La commande a été créée mais elle a été interrompue avant choix du paiement => valider = 0 , reference = 0, payer = 0 => stocks virtuels non modifiés, pas d'avoir généré, annulation simple
                // 2 - La commande a été créée mais elle a été interrompue lors du paiement => valider = 0 , reference existe, stock virtuel affecté, payer = 0 => stocks virtuels à redresser, pas d'avoir généré                
                // 3 - La commande a été validée, payée ou non, mais non préparée, et rétractation => valider = 1, payer = 0 ou payer = 1 => la commande n'est pas annulée, un avoir total est généré, stocks virtuels redressés
                // 4 - La commande a été préparée, livrée ou non, et rétractation => stocks virtuels et stocks réels à redresser, la commande n'est pas annulée : un avoir total est généré
                // 5 - La commande a été préparée partiellement, livrée ou non, et rétractation => avoir rattaché => = 4 mais cumul commande et avoir correspondant
                // 6 - Cas d'un avoir 9 annulé : on supprime l'avoir et on corrige les stocks
                // 7 - Cas d'un avoir 8 annulé : on supprime l'avoir et la commande correspondante (donc variation stocks = 0)

                // 1 - : reference = 0 et valider = 0
                if( $Commande->getValider() == 0 && $Commande->getReference() == 0){   $em->remove($Commande);     }
                else
                {
                    $Commande1=null;
                    $match =  preg_match('/^(\\d{1})/', $Commande->getReference(), $matches);
                    // 7 - : avoir avec reference = 8xxxxxxx associé à reference = 1xxxxxxx
                    if( (int)$matches[1] == 8 ){ 
                        $ref0 = $Commande->getReference();
                        $ref1 = preg_replace('/^(\d{1})/', 1,$Commande->getReference());
                        $commande1 = $em->getRepository('EcomBundle:Commandes')->findOneBy(array('reference' => $ref1));
                        $em->remove($Commande);
                        if($commande1) $em->remove($commande1);
                    }
                    else
                    {
                    // 2 à 6 - Correction des stocks virtuels et réels :            
                        $commande = $Commande->getCommande();
                        if(array_key_exists('produit', $commande)) {$produits = $commande['produit'];}
                        else{$produits = array();}
                        foreach($produits as $id => $produit)
                        {               
                            $produitB =  $em->getRepository('EcomBundle:Produits')->find($id);
                            $stockvirtuel = $produitB->getStockvirtuel();               
                            $stockreel = $produitB->getStockreel();
                            $qtePanier = $produit['quantite'];
                            //Dans tous les cas :
                            $stockvirtuel = $stockvirtuel + $qtePanier;
                            $produitB->setStockvirtuel($stockvirtuel);
                            //Cas 4 à 6 commande préparée ou avoir(et éventuellement livrée) :
                            if( $Commande->getPreparer() > 0){
                                $stockreel = $stockreel + $qtePanier;
                                $produitB->setStockreel($stockreel);
                            }
                            $em->persist($produitB); 
                        }  
                        // Cas 5 : avoir accompagnant la commande annulée
                        if($Commande->getPreparer()==2)
                        {
                            $ref0 = $Commande->getReference();
                            $ref1 = preg_replace('/^(\d{1})/', 9,$ref0);
                            $Commande1 = $em->getRepository('EcomBundle:Commandes')->findOneBy(array('reference' => $ref1));
                            $commande1 = $Commande1->getCommande();
                            if(array_key_exists('produit', $commande1)) {$produits = $commande1['produit'];}
                            else{$produits = array();}
                            foreach($produits as $id => $produit)
                            {               
                                $produitB =  $em->getRepository('EcomBundle:Produits')->find($id);
                                $stockvirtuel = $produitB->getStockvirtuel();               
                                $stockreel = $produitB->getStockreel();
                                $qtePanier = -$produit['quantite'];
                                $stockvirtuel = $stockvirtuel + $qtePanier;
                                $produitB->setStockvirtuel($stockvirtuel);
                                $stockreel = $stockreel + $qtePanier;
                                $produitB->setStockreel($stockreel);
                                
                                $em->persist($produitB); 
                            }                                                        
                        }               
                    }
                    // 3 à 5 : commande avec valider = 1 : on génère un avoir total
                    if( $Commande->getValider() > 0 && (int)$matches[1] < 8 )
                    { 
                       // if($Commande1) $Commande1=null; // Cas 5

                        // On génère l'avoir comme une nouvelle commande :
                        $Avoir = $this->genereAvoirTotal($Commande, $Commande1);                    
                        $em->persist($Avoir);

                        // On colore préparer ou livrer dans la commande :
                        if($Commande->getPreparer() <= 0) {$Commande->setPreparer('3');}
                        if($Commande->getPreparer() > 0 && $Commande->getPreparer() < 3 && $Commande->getLivrer() <= 0) $Commande->setLivrer('2');
                        if($Commande->getPreparer() > 0 && $Commande->getPreparer() < 3 && $Commande->getLivrer() == 1) $Commande->setLivrer('3');
                        $em->persist($Commande);
                    }  
                    // 6 - : avoir avec reference = 9xxxxxxx associé à reference = 1xxxxxxx : on supprime l'avoir seulement
                    if( (int)$matches[1] == 9 )
                    { 
                        $ref0 = $Commande->getReference();
                        $em->remove($Commande);
                    }
                }
            }
            $em->flush();  
            //echo('count($avoir)='.count($avoir)); die();

    // MAIL DE STATUT envoyé à la préparation et au départ livraison:
            if($prepareId[$id] || $livreId[$id])
            {
                $match =  preg_match('/^(\\d{1})/', $Commande->getReference(), $matches);
                $message = \Swift_Message::newInstance();
                $basePath = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
                $imgUrl = $basePath.'/img/LogoProG8.PNG';
                $message  ->setSubject('Votre commande en cours')
                          ->setFrom(array('pascal.p8610@gmail.com'=>"ProG-dev"))
                          ->setTo($Commande->getUtilisateur()->getEmailCanonical())
                          ->setCharset('utf-8')
                          ->setContentType('text/html');

                if($prepareId[$id])
                {
                    //Problème : stock insuffisant => avoir ou envoi plus tard ? on gère a priori comme un avoir.
                    //var_dump($avoir); die();
                    if( count($avoir) > 0 ) 
                    { 
                        $avoirComplet = array();
                        //var_dump($avoir);
                        foreach($avoir[$id] as $idProduit => $qte)
                        {
                            $produitB =  $em->getRepository('EcomBundle:Produits')->find($idProduit);
                            $nom = $produitB->getNom();
                            $taille = $produitB->getTaille();

                            $commande = $Commande->getCommande();
                            $produits = $commande['produit'];
                            foreach($produits as $id => $produit)
                            {     
                                if($id == $idProduit) 
                                {  
                                    $qtePanier = $produit['quantite'];
                                    $pasPossible = $qte;
                                    $prixHT = $produit['prixHT'];
                                    $prixTTC = $produit['prixTTC'];
                                    $avoirComplet[$idProduit] = array('nom' => $nom, 'taille'=> $taille,'qte'=> $pasPossible, 'qtePanier'=>$qtePanier, 'prixHT'=>$prixHT, 'prixTTC'=>$prixTTC );
                                }
                            }
                        }
                        //var_dump($avoirComplet); die();
                        //Il va manquer $avoirComplet[$idProduit]=>nom, qte sur qtePanier, d'où avoir de qte x prixTTC

                        $message = $message->setBody($this->renderView('EcomBundle:Default:SwiftLayout/preparePbCommande.html.twig', 
                        array('utilisateur'=> $Commande->getUtilisateur(), 'vendeur'=>$vendeur, 'avoirComplet'=>$avoirComplet, 'url'=>$imgUrl))); 
                    }                    
                    else
                    {
                    //Pas de problème : stocks suffisants => simple message d'info 'la commande est préparée' :    
                       
                       $message = $message->setBody($this->renderView('EcomBundle:Default:SwiftLayout/prepareCommande.html.twig', 
                        array('utilisateur'=> $Commande->getUtilisateur(), 'vendeur'=>$vendeur, 'url'=>$imgUrl)))
                        ;  
                    }
                }
            

                if($livreId[$id]) { 
                    if((int)$matches[1] < 8)
                    {
                    $message = $message->setBody($this->renderView('EcomBundle:Default:SwiftLayout/livreCommande.html.twig', 
                        array('utilisateur'=> $Commande->getUtilisateur(), 'vendeur'=>$vendeur, 'url'=>$imgUrl)));                         
                    }
                    elseif((int)$matches[1] == 8)
                    {
                    $message = $message->setBody($this->renderView('EcomBundle:Default:SwiftLayout/envoiAvoir.html.twig', 
                        array('utilisateur'=> $Commande->getUtilisateur(), 'vendeur'=>$vendeur, 'url'=>$imgUrl)));                         
                    }
                }
                $this->get('mailer')->send($message);            
            }
            $payeId[$id];$prepareId[$id]=false;$livreId[$id]=false; $archiveId[$id]=false;$supprId[$id]=false;
            $archive = "en cours";
            $entities = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 0),array('date'=>'asc'));  
            return $this->render('AdBundle:Administration:Commandes/layout/index.html.twig', array(
                'entities' => $entities, 'archive' => $archive
            ));
        }
        return $this->redirect($this->generateUrl('adminCommandes'));
    }

    private function stockAvoir($Commande)
    {
        // Suite à démarque, le stock virtuel est négatif ; plusieurs commandes peuvent être affectées
        // Le stock réel peut être encore élevé, mais une au moins des commandes ne pourra pas être honorée
        // tant qu'un réassort ne sera pas fait.
        // Cette action va envoyer un mail au client en principe le plus récent (ou pas)
        $avoir=array();
        $em = $this->getDoctrine()->getManager();
        $commande = $Commande->getCommande();
        $produits = $commande['produit'];

        foreach($produits as $id => $produit)
        {
            $ProduitB = $em->getRepository('EcomBundle:Produits')->find($id);
            $qtePanier = $produit['quantite'];
            // Exemple 1 : le stock virtuel est à -10 et ma commande est de 3 => avoir de 3 ; possible = 0
            // Exemple 2 : le stock virtuel est à -1 et ma commande est de 3 => avoir de 1 ; possible = 2
            $stockvirtuel = $ProduitB->getStockvirtuel(); 
            $stockreel    = $ProduitB->getStockreel();
            $id           = $ProduitB->getId();

            $possible = min($qtePanier, max(0, $qtePanier + $stockvirtuel));
            if ($possible < $qtePanier) $avoir[$id] = $qtePanier - $possible;
            
            // On prépare le colis avec les quantités possibles :
            $stockreel = $stockreel - $possible;
            $ProduitB->setStockreel($stockreel);
            // Le stock virtuel est corrigé à hauteur des quantités annulées :
            if ($possible < $qtePanier) $stockvirtuel = $stockvirtuel + $avoir[$id];           
            $ProduitB->setStockvirtuel($stockvirtuel);

            $em->persist($ProduitB);
        }

        $em->flush();

        return $avoir;
    }

    private function genereAvoirPart($Commande, $avoir,$id)
    {
                $Avoir = new Commandes();
                $Avoir->setDate(new \DateTime());
                $Avoir->setReference( preg_replace('/^\d{1}/',9,$Commande->getReference())); 
                $avoirBuilt = array();
                $totalHT =0;
                $totalTVA = 0;
                $em = $this->getDoctrine()->getManager();
                foreach($avoir[$id] as $idProduit=>$qte)
                {
                    //echo('id='.$idProduit.' ; qte='.$qte.'</br>');
                    $commandeC = $Commande->getCommande();
                    if(array_key_exists('produit',  $commandeC)) 
                    {
                        $produitsC = $commandeC['produit'];
                        foreach($produitsC as $idp => $produit)
                        {               
                            if($idp == $idProduit)
                            {
                                $produitB = $em->getRepository('EcomBundle:Produits')->find($idp);
                                $reference = $produit['reference'];
                                $prixHT = $produit['prixHT'];
                                $prixTTC = $produit['prixTTC']; 
                                $totalHT += -$prixHT * $qte;  
                                if (!isset($avoirBuilt['tva']['%'.$produitB->getTva()->getValeur()]))
                                    $avoirBuilt['tva']['%'.$produitB->getTva()->getValeur()] = round( -$qte*($prixTTC - $prixHT), 2);
                                else
                                    $avoirBuilt['tva']['%'.$produitB->getTva()->getValeur()] += round( -$qte*($prixTTC - $prixHT), 2); 
                                $totalTVA += round( -$qte*($prixTTC - $prixHT),2); 
                                $avoirBuilt['produit'][$idProduit] = array('reference' => $reference,
                                                                       'quantite' => -$qte,
                                                                         'prixHT' => $prixHT,
                                                                        'prixTTC' => $prixTTC );    
                            }
                        }
                    }
                    $avoirBuilt['livraison'] = $commandeC['livraison'];
                    $avoirBuilt['facturation'] = $commandeC['facturation'];
                    $avoirBuilt['totalHT'] = round($totalHT,2);
                    $avoirBuilt['org'] ="";
                    $avoirBuilt['nom'] ="";
                    $avoirBuilt['frPort'] = 0;
                    $avoirBuilt['totalTTC'] = round($totalHT+$totalTVA,2);
                    $avoirBuilt['token'] = bin2hex($generator->nextBytes(20));

                }
                //var_dump($avoirBuilt); die();
              
                $Avoir->setUtilisateur($Commande->getUtilisateur());
                $Avoir->setValider(1);      
                $Avoir->setPayer(1);
                $Avoir->setModpmt(4);
                $Avoir->setCommande($avoirBuilt); 
                $Avoir->setPreparer(1);
                $Avoir->setLivrer(0);
                $Avoir->setArchiver(0);

                return $Avoir;
    }

    private function genereAvoirTotal($Commande, $Commande1 = null)
    {
        $Avoir = new Commandes();
        $Avoir->setDate(new \DateTime());
        $Avoir->setReference( preg_replace('/^\d{1}/',8,$Commande->getReference())); 
        $avoirBuilt = array(); $totalTVA = 0 ; $totalHT=0;
        $em = $this->getDoctrine()->getManager();
        $commandeC = $Commande->getCommande();    
        if($Commande1){
            $commandeA = $Commande1->getCommande();
            if(array_key_exists('produit',  $commandeA)) 
            {
                $produitsA = $commandeA['produit'];
            }
        }
        else{$commandeA=null;}
        if($commandeC){
            if(array_key_exists('produit',  $commandeC)) 
            {
                $produitsC = $commandeC['produit'];
                foreach($produitsC as $idp => $produit)
                {   
                    $produitB = $em->getRepository('EcomBundle:Produits')->find($idp);
                    $reference = $produit['reference'];
                    $qte = $produit['quantite'];
                    if($Commande1 && $commandeA && $produitsA){
                        foreach($produitsA as $idpA => $produitA)
                        {  
                            if($idpA == $idp){
                                $qte -= $produitA['quantite'];
                            }
                        } 
                    }
                    $prixHT = $produit['prixHT'];
                    $prixTTC = $produit['prixTTC']; 
                    $totalHT += $prixHT * $qte; 
                    if (!isset($avoirBuilt['tva']['%'.$produitB->getTva()->getValeur()]))
                        $avoirBuilt['tva']['%'.$produitB->getTva()->getValeur()] = -round($qte*($prixTTC - $prixHT), 2);
                    else
                        $avoirBuilt['tva']['%'.$produitB->getTva()->getValeur()] -= round($qte*($prixTTC - $prixHT), 2); 
                    $totalTVA -= round($qte*($prixTTC - $prixHT),2); 
                    
                    $avoirBuilt['produit'][$idp] = array('reference' => $reference,
                                                          'quantite' => -$qte,
                                                            'prixHT' => $prixHT,
                                                           'prixTTC' => $prixTTC );                       
                }
            }
            $frPort = $commandeC['frPort'];
            $avoirBuilt['livraison']   = $commandeC['livraison'];
            $avoirBuilt['facturation'] = $commandeC['facturation'];
            $avoirBuilt['totalHT']     = -round($totalHT,2);
            $avoirBuilt['totalTTC']    = -round($totalHT-$totalTVA+$frPort,2);
            $avoirBuilt['org']         = $commandeC['org'];
            $avoirBuilt['nom']         = $commandeC['nom'];
            $avoirBuilt['frPort']      = - $frPort;
            $avoirBuilt['token']       = $commandeC['token'];
        }
        //var_dump($avoirBuilt); die();
      
        $Avoir->setUtilisateur($Commande->getUtilisateur());
        $Avoir->setValider(1);      
        $Avoir->setPayer(1);
        $Avoir->setModpmt(4);
        $Avoir->setCommande($avoirBuilt); 
        $Avoir->setPreparer(1);
        $Avoir->setLivrer(0);
        $Avoir->setArchiver(0);

        return $Avoir;
    }

    public function facturePDFAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //on récupère la  facture de $id en vérifiant que c'est bien le bon utilisateur et que valider=1 :  
        $facture = $em->getRepository('EcomBundle:Commandes')->find($id) ; 
        if(!$facture){
            $this->getFlashBag()->add('error', 'une erreur est survenue');
            return $this->redirect($this->generateUrl('adminCommandes'));
        }

        $this->container->get('setNewFacture')->facture($facture);
    }

    public function bonlivraisonPDFAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //on récupère la  facture de $id en vérifiant que c'est bien le bon utilisateur et que valider=1 :  
        $facture = $em->getRepository('EcomBundle:Commandes')->find($id) ; 
        if(!$facture){
            $this->getFlashBag()->add('error', 'une erreur est survenue');
            return $this->redirect($this->generateUrl('adminCommandes'));
        }

        $this->container->get('setNewBL')->bonlivraison($facture);
    }    


    /**
     * Creates a new Commandes entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Commandes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adminCommandes_show', array('id' => $entity->getId())));
        }

        return $this->render('AdBundle:Administration:Commandes/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Commandes entity.
     *
     * @param Commandes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Commandes $entity)
    {
        $form = $this->createForm(CommandesType::class, $entity, array(
            'action' => $this->generateUrl('adminCommandes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Commandes entity.
     *
     */
    public function newAction()
    {
        $entity = new Commandes();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdBundle:Administration:Commandes/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Commandes entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:Commandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commandes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdBundle:Administration:Commandes/layout/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Commandes entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:Commandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commandes entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdBundle:Administration:Commandes/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Commandes entity.
    *
    * @param Commandes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Commandes $entity)
    {
        $form = $this->createForm(CommandesType::class, $entity, array(
            'action' => $this->generateUrl('adminCommandes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Commandes entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:Commandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commandes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adminCommandes_edit', array('id' => $id)));
        }

        return $this->render('AdBundle:Administration:Commandes/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Commandes entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EcomBundle:Commandes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Commandes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminCommandes'));
    }

    /**
     * Creates a form to delete a Commandes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminCommandes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    function nbreVisitesAction(){
        $em = $this->getDoctrine()->getManager();
        $tabVisites=array(); $tabSemVisites=array();

        for ( $s=1 ; $s<9 ; $s++)
        {
            $tabSemVisites[$s]=0;
            $semaine = (int)date('W')-$s; $annee = (int)date('Y');   

            if($semaine == 0){$semaine = 54-$s; $annee = (int)date('Y')-1;}  
            
            $Visites = $em->getRepository('EcomBundle:Visites')->findBy(array('semaine'=>$semaine, 'annee'=>$annee));
            if(!$Visites){ $tabSemVisites[$s]= 0 ; }
            else{$tabSemVisites[$s]=$Visites[0]->getNbrevisites();   }   

        }
        //var_dump($tabSemVisites); die();  
        // Semaine précédente :
        $tabVisites[5] = $tabSemVisites[1];

        // Semaine antérieure :
        $tabVisites[4] = $tabSemVisites[2];

        // 4 dernières semaines :
        $tabVisites[3] = $tabSemVisites[1]+$tabSemVisites[2]+$tabSemVisites[3]+$tabSemVisites[4];

        // 4 semaines précédentes :
        $tabVisites[2] = $tabSemVisites[5]+$tabSemVisites[6]+$tabSemVisites[7]+$tabSemVisites[8];

        // Total :
        $tabVisites[1]=0;$visites=0;
        $visites = $em->getRepository('EcomBundle:Visites')->findAllVisites();
        $tabVisites[1] = $visites;  
        
        

        return $this->render('AdBundle:Administration:Commandes/modulesUsed/nbVisites.html.twig', array(
            'tabVisites' => $tabVisites ));
    }


    public function error404Action(Request $request)
    {
       if($request->getMethod() == "GET") 
        {
            $message="tagada";
        }
        // Mail d'alerte':
      $Vendeur = $em->getRepository('AdBundle:Vendeur')->find('1');
      $message = \Swift_Message::newInstance()
              ->setSubject('erreur 404 dans le site ecom01')
              ->setFrom(array('pascal.p8610@gmail.com'=>"ProG-dev"))
              ->setTo($Vendeur[0]->getEmail())
              ->setCharset('utf-8')
              ->setContentType('text/html')
              ->setBody('Une erreur 404 est survenue sur le site ecom01. Message envoyé :'.$message);
      $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl($_SERVER["HTTP_REFERER"]));
    }

    public function error500Action($page = null)
    {
        if($request->getMethod() == "GET") 
        {
            $message="tagada";
        }
        // Mail d'alerte':
      $Vendeur = $em->getRepository('AdBundle:Vendeur')->find('1');
      $message = \Swift_Message::newInstance()
              ->setSubject('erreur 500 dans le site ecom01')
              ->setFrom(array('pascal.p8610@gmail.com'=>"ProG-dev"))
              ->setTo($Vendeur[0]->getEmail())
              ->setCharset('utf-8')
              ->setContentType('text/html')
              ->setBody('Une erreur 500 est survenue sur le site ecom01. Message envoyé :'.$message);
      $this->get('mailer')->send($message);
      return $this->redirect($this->generateUrl($_SERVER["HTTP_REFERER"]));
    }
}
