<?php

namespace DV\EcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use DV\EcomBundle\Form\UtilisateursAdressesType;
use DV\EcomBundle\Form\LivraisonType;
use DV\EcomBundle\Entity\UtilisateursAdresses;
use DV\EcomBundle\Entity\Transport;


class PanierController extends Controller
{
    /*  
    *  Méthodes concernant le contenu du panier :
    *   .menuAction(Request $request)            => Retourne le nombre d'articles du panier => panier/menu.html.twig
    *   .menupanierAction(Request $request)      => Menu avancement Panier > Connexion > Adresses > Livraison > Paiement
    *                                            => panier/menuPanier.html.twig
    *   .panierAction(Request $request)          => Affichage du panier avec produits+quantités
    *                                            => panier/panier.html.twig
    *   .ajouterAction($id, Request $request)    => Modification de la quantité d'un produit du panier => 'panier'
    *   .supprimerAction($id,  Request $request) => Suppression d'un produit dans le panier => 'panier'
    *
    *  Méthodes concernant les adresses facturation et livraison :
    *   .adressesAction(Request $request)        => Ajoute une adresse de facturation ou de livraison dans UtilisateurAdresses
                                                 => panier/adresses.html.twig
    *   .adresseSuppressionAction($id)           => Supprime une adresse de facturation ou de livraison dans UtilisateurAdresses
    *   .validationAdressesAction( Request $request) => Effectue les 2 fonctions suivantes, récupère le choix livraison 
    *                                            => met en session l'objet transport et un objet livraison 
    *   .setAdressesOnSession( Request $request) => Met les identifiants facturation et livraison en session
    *   .frlivraison( $produits, $livraison, Request $request) => calcule les frais de port selon les différents tarifs
    *   .calculTarif($tarif, $totalPoids)        => calcule un tarif
    *   
    *  Méthodes concernant la préparation de la commande :
    *   .validationAction( Request $request)     =>  Lance Commandes:prepareCommande => panier/validation.html.twig
    *   .showcgvAction( Request $request)        =>  Demande acceptation des CGV
    */

    /*  
    *  Méthodes concernant le contenu du panier :
    */
    public function menuAction(Request $request)
    {
        // Retourne le nombre d'articles du panier :
        $session = $request->getSession();
        if (!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));

        return $this->render('EcomBundle:Default:panier/modulesUsed/menu.html.twig', array('articles' => $articles));
    }

    public function menupanierAction(Request $request)
    {
        // Retourne le nombre d'articles du panier :
        $session = $request->getSession();
        $adr = false ; $livr = false; $pmt = false;
        //var_dump($session->get('tabFrPort'));
        //die();
        
        if (!$session || !$session->has('livraison') || $session->get('livraison') == null || $session->get('livraison')['adresse'] == null )
            {$adr = false;}
        else
        {   $adr = true;
            if($session->has('tabFrPort')) $tabFrPort = $session->get('tabFrPort');
            if(!$session->has('tabFrPort') || ($session->has('tabFrPort') && !array_key_exists('choix',$tabFrPort  )) || (array_key_exists('choix',$tabFrPort  ) && $tabFrPort['choix'] == null ) )
            {   $livr = false;}
            else
            {   $livr = true;
                if(!$session->has('paiement') || $session->get('paiement') == null || $session->get('paiement') == false)
                {   $pmt = false;}
                else
                {   
                    if($this->get('session')->getFlashBag()->has('success') ) $pmt = true; 
                    else $pmt = false;
                }
            }
        }

        return $this->render('EcomBundle:Default:panier/modulesUsed/menupanier.html.twig', array('adr' => $adr, 'livr' => $livr, 'pmt'=>$pmt));
    }

    public function panierAction(Request $request)
    {
        //Retourne un tableau contenant la liste des idProduit + quantité :
        $session = $request->getSession(); 
   
        if (!$session->has('panier')) $session->set('panier', array()); 
        $em = $this->getDoctrine()->getManager();
        $promoProds = $em->getRepository('EcomBundle:PromoProds')->findAllPromoProdProd(); 
        $panier =  $session->get('panier');
        $array = array_keys($panier);
        $now =  new \DateTime();

        $produits = $em->getRepository('EcomBundle:Produits')->findArray($array);  
        //var_dump($produits); die();
        
        return $this->render('EcomBundle:Default:panier/layout/panier.html.twig', array('produits' => $produits, 'panier' => $session->get('panier'), 'now'=>$now));
    }

    public function ajouterAction($id, $prix=null, Request $request)
    {
        //Rajoute s'il n'existe pas déjà, ou met à jour, un couple idProduit + quantité dans le panier 
        // => $panier[$id]['qte'] contient, ainsi, la quantité du produit :
        //Rajoute également prix pour gérer les promotions

        //Incrémentation de la popularité :
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('EcomBundle:Produits')->find($id);        
        $popularite = $produit->getPopularite();
        $produit->setPopularite($popularite+1);
        $em->persist($produit);
        $em->flush();
        
        //Rajout du produit dans le panier avec la quantité indiquée et le prix effectif :
        $session =  $request->getSession(); 
        if (!$session->has('panier')) $session->set('panier', array());
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier))
        {
            // ce produit existe déjà dans le panier...            
            if ($request->query->get('qte') != null) 
            {
                $panier[$id]['qte'] = $request->query->get('qte');
                $panier[$id]['prix'] = $request->query->get('prix');
            }
        }
        else
        {
            // ce produit n'existe pas encore dans le panier...           
            if ($request->query->get('qte') != null) 
            { 
                $panier[$id]['qte'] = $request->query->get('qte');
                $panier[$id]['prix'] = $request->query->get('prix');
            }
            else
            { 
                $panier[$id]['qte'] = 1;
            // On récupère le prix qui sinon reste à zéro jq'à la commande si la qté n'est pas modifiée :
                if($prix!=null) $panier[$id]['prix'] = $prix;
                else $panier[$id]['prix'] = 0;    
            }
        } 
        $session->set('panier', $panier);

        // La modification du panier annule les calcul des frais de port et la commande :
        if($session->get('tabFrPort')) $session->remove('tabFrPort');
        if($session->get('commande'))  $session->remove('commande');
        
        return $this->redirect($this->generateUrl('panier'));
    }

    public function supprimerAction($id,  Request $request)
    {
        //Supprime un article du panier
        $session = $request->getSession();
        $panier = $session->get('panier');
        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier', $panier);
            $this->get('session')->getFlashBag()->add('success', 'Article supprimé avec succès');
            if($session->get('tabFrPort')) $session->remove('tabFrPort');     
            if($session->get('commande'))  $session->remove('commande');
        } 
        return $this->redirect($this->generateUrl('panier'));
    }

    /**
     *  
     *  Méthodes concernant les adresses facturation et livraison
     *
     */
    public function adressesAction(Request $request)
    {
        //Ajoute une adresse de facturation ou de livraison dans UtilisateurAdresses :
        //Initialisations :
        $utilisateur = $this->container->get('security.token_storage')->getToken()->getUser();        
        $entity = new UtilisateursAdresses();
        $entity->setFact(true); $entity->setLivr(true);
        $form = $this->createForm(new UtilisateursAdressesType, $entity);
        //Cas où on a déjà rentré une adresse mémorisée en session :
        $session = $request->getSession();
        if (!$session->has('adresse')) {$session->set('adresse', array()); $adresse = null;}
        else {$adresse = $session->get('adresse');  }

        // Récupération des données saisies dans le formulaire 'nouvelle adresse':
        if($request->getMethod() == "POST")
        {            
            $form->handleRequest($request); //On récupère le formulaire en cours                        
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                //On rajoute le champ utilisateur :
                $entity->setUtilisateur($utilisateur);
                //On enregistre l'ensemble de la nouvelle adresse dans la table UtilisateursAdresses :
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('adresses'));
            }
        }  
        // Préparation du formulaire choix des adresses facturation et livraison :
        

        //Envoi du formulaire 'ajouter une nouvelle adresse' à la vue :   
        return $this->render('EcomBundle:Default:panier/layout/adresses.html.twig', array('utilisateur'=>$utilisateur, 'form'=>$form->createView(), 'adresse', $adresse));
    }
    public function adresseSuppressionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EcomBundle:UtilisateursAdresses')->find($id)  ;    
        //On vérifie que c'est bien l'utilisateur qui supprime son adresse :
        if ($this->container->get('security.token_storage')->getToken()->getUser() != $entity->getUtilisateur() || !$entity)
        {
            return ($this->redirect($this->generateUrl('adresses')));
        }
        $em->remove($entity);
        $em->flush();
        return ($this->redirect($this->generateUrl('adresses')));
    }

    
    public function validationAdressesAction( Request $request)
    { 
        // On arrive ici via la route 'frlivraison' : validation des adresses de livraison et facturation
        // 1 - Si on arrive ici depuis adresses.html.twig, on met les id des adresses en session :
        if($request->getMethod() == "POST") $this->setAdressesOnSession($request);
        // 1bis - et sinon, dans tous les cas, on récupère les adresses mises en session :
        $session = $request->getSession();
        if(!$session->get('panier'))  return ($this->redirect($this->generateUrl('produits')));
        if (!$session->has('adresse')) $session->set('adresse', array()); 
        $adresse = $session->get('adresse');  
        $livraison = array(); 

        // 2 - On récupère les éléments nécessaires au calcul des frais de port (panier, poids des produits, adresse de livraison, ...) :
        $em = $this->getDoctrine()->getManager();         
        $produits = $em ->getRepository('EcomBundle:Produits')->findArray(array_keys($session->get('panier'))); 
        $Livraison = $em ->getRepository('EcomBundle:UtilisateursAdresses')->find($adresse['livraison']);
        //$Facturation = $em ->getRepository('EcomBundle:UtilisateursAdresses')->find($adresse['facturation']);

        // 3 - On met l'adresse de livraison en session (distincte de adresse['livraison'] car modifiable):   
        $livraison['nom'] = $Livraison->getNom();
        $livraison['prenom'] = $Livraison->getPrenom();
        $livraison['adresse'] = $Livraison->getAdresse();
        $livraison['complement'] = $Livraison->getComplement();
        $livraison['cp'] = $Livraison->getCp();
        $livraison['ville'] = $Livraison->getVille();  
        $livraison['pays'] = $Livraison->getPays();  
        $livraison['telephone'] = $Livraison->getTelephone(); 
        if (!$session->has('livraison')) $session->set('livraison', array()); 
        $session->set('livraison', $livraison); 
    //echo '<pre>';var_dump($session);echo '</pre>';
        
        // 4 - On calcule les frais de port qu'on passe en session :
        $tabFrPort = $this->frlivraison($produits, $livraison, $request);
        $session->set('tabFrPort', $tabFrPort); 

        //5 - On prépare un objet Transport destiné au formulaire choix du mode de livraison :
        $transport = new Transport();
        $transport->setNom( $Livraison->getNom());
        $transport->setPrenom($Livraison->getPrenom());
        $transport->setAdresse($Livraison->getAdresse());
        $transport->setComplement($Livraison->getComplement());
        $transport->setCp($Livraison->getCp());
        $transport->setVille($Livraison->getVille());

        $form = $this->createForm(new LivraisonType, $transport);

        // Pré-sélection du tarif le moins cher :
        switch($tabFrPort['minI'])
        {
            case 1: $minI = "1"; break;
            case 2: $minI = "2"; break;
            default: $minI ="3"; 
        } 
        $form->add('modport', HiddenType::class, array( 'attr' => array('value' =>$minI,'class' => 'cb_Modpost')))
             ->add('submit', SubmitType::class, array('label' => 'Valider ce choix de livraison', 'attr'=>array('class'=>'btn btn-info pull-right')));

       // 6 - On récupère le choix et les frais de port correspondants, pour créer la commande, l'enregistrer et la retourner vers validation.html.twig
        if($request->getMethod() == "POST")
        {            
            $form->handleRequest($request);                      
            if($form->isValid())
            {
                // 61 - On récupère le choix du mode de livraison et frais de port correspondants
                $session = $request->getSession();  

                if (!$session->has('tabFrPort')) $tabFrPort = array();
                $tabFrPort = $session->get('tabFrPort');
                $modPort = $transport->getModport();
                switch($modPort)
                {
                    case 1: $choixFrPort = $tabFrPort['autre']; break;
                    case 2: $choixFrPort = $tabFrPort['colissimo']; break;
                    case 3: $choixFrPort = $tabFrPort['petit']; break;
                    default: $choixFrPort = null;
                }
                if (!$session->has('tabFrPort')) $tabFrPort['choix'] = null;
                $tabFrPort['choix'] = $choixFrPort; // $tabFrPort['choix'] contient organisme, image, nom et frPort choisi
                $session->set('tabFrPort', $tabFrPort); // On met l'ensemble de $tabFrPort en session

                // 62 - On met à jour l'adresse de livraison de la commande si elle a été modifiée (point relais) :       
                if (!$session->has('livraison')) $livraison = array(); 
                $livraison = $session->get('livraison'); 
                $livraison['nom'] = $transport->getNom();
                $livraison['prenom'] = $transport->getPrenom();
                $livraison['adresse'] = $transport->getAdresse();
                $livraison['complement'] = $transport->getComplement();
                $livraison['cp'] = $transport->getCp();
                $livraison['ville'] = $transport->getVille();
                
                // On met livraison (éventuellement modifié ) en session, mais on laisse intacte la base de données
                $session->set('livraison', $livraison) ;  

                // 63 - On lance Commandes:validationAction qui affiche validation.html.twig
               return $this->redirect($this->generateUrl('validation'));      
            }
            // Erreur validation formulaire :
            return $this->redirect($this->generateUrl('frlivraison'));
        }

        //5bis - affichage de livraison.html.twig et du formulaire choix du mode de livraison :
        return $this->render('EcomBundle:Default:panier/layout/livraison.html.twig',  array('livraison' => $livraison, 'frPort' => $tabFrPort, 'minI'=>$minI, 'form'=>$form->createView() ) );
    }   


    private function setAdressesOnSession( Request $request)
    {
        //On vient de validationAdressesAction()
        //Place adresse de facturation et adresse de livraison en session - retour à frlivraisonAction
        //On récupère les adresses présentes en session :
        $session = $request->getSession();
        if (!$session->has('adresse')) $session->set('adresse', array()); 
        $adresse = $session->get('adresse');  

        // On verifie le renvoi des "POST" : si reçus, on met dans $adresse
        if( $request->request->get('livraison') != null &&  $request->request->get('facturation') != null )
        {
            $adresse['livraison'] = $request->request->get('livraison'); // = $_REQUEST['livraison'] ou $_POST['livraison']
            $adresse['facturation'] = $request->request->get('facturation'); // = $_REQUEST['facturation'] ou $_POST['facturation']
        }  
        else
        {
             return $this->redirect($this->generateUrl('adresses')); // On reste sur la page 'adresses'
        } 
        //On met $adresse en session :
        $session->set('adresse', $adresse); 

        //On met à jour prenom, nom et telephone de l'utilisateur dans la base utilisateurs :
        $em = $this->getDoctrine()->getManager();
        $adresseFact = $em->getRepository('EcomBundle:UtilisateursAdresses')->find($adresse['facturation'])  ;        
        $utilisateurs = $em->getRepository('UtilisateursBundle:Utilisateurs')->findById($adresseFact->getUtilisateur())  ; 

        foreach($utilisateurs as $utilisateur)  
        {
        $utilisateur->setPrenom($adresseFact->getPrenom());
        $utilisateur->setNom($adresseFact->getNom());
        $utilisateur->setTelephone($adresseFact->getTelephone());
        $utilisateur->setCp($adresseFact->getCp());
        $em->persist($utilisateur);
        $em->flush();            
        }     

        //On revient à la route 'frlivraison' et à validationAdressesAction() :
        return $this->redirect($this->generateUrl('frlivraison')); 
    }

    /**
    **  
    **  Méthodes concernant les frais de port
    **
    **/
    private function frlivraison( $produits, $livraison, Request $request)
    {
            //Calcul les frais de port pour la livraison

            //1 - récupération du panier (produits et nombre)

            $session = $request->getSession();    

            if (!$session->has('panier')) $session->set('panier', array()); 
            $panier = $session->get('panier');

            //2 - Détermination des données diverses

        /* Paramètres emballage extérieur */
            $poidsEmb1 = 0.0001; // poids par mm² 100g/m² => si poids total<500g
            $epaissEmb1 = 2; // epaisseur en mm un côté
            $poidsEmb2 = 0.0002; // poids par mm² 200g/m² => si poids total>=500g et <5kg
            $epaissEmb1 = 3; // epaisseur en mm un côté
            $poidsEmb3 = 0.0004; // poids par mm² 400g/m² => si poids total>5kg
            $epaissEmb3 = 5; // epaisseur en mm un côté

        /* Paramètres emballage intérieur */
            $poidsInt = 0.00005;// poids par mm² 50g/m²
            $epaissInt = 0.4; // epaisseur en mm un côté

        /* Paramètre pourcentage de vide dans l'emballage extérieur */
            $tauxVide = 0.20;
            $tauxVideEpais = 0.05;

        /* Pays europe */
            $europe = array('allemagne', 'deutschland', 'autriche', 'osterreich', 'belgique', 'belgie', 'bulgarie', 'chypre', 'croatie', 'danemark','espagne', 'espana', 'estonie', 'estonia', 'finlande', 'grèce', 'hongrie', 'irlande', 'italie', 'lettonie', 'lituanie', 'luxembourg', 'malte','pays-bas', 'pologne', 'portugal', 'république tchèque', 'roumanie', 'royaume-uni', 'slovaquie','slovénie', 'suède', 'suisse', 'liechtenstein', 'saint-marin', 'vatican');

            //3 - Calculs intermédiaires
            $poids = 0; $totalPoids = 0; $frPort = 0; $frPortA =0; $epaissMax = 0; $largMax = 0; $tailleMax =0; $epEmb=5; $idmax=0; $volmax=0; $sommeLarg = 0; $tabFrPort = array(); $tabFrPort['minI']=0;$tabFrPort['minF']=0;
        /* calcul des dimensions et poids maximals*/
            foreach($produits as $produit)
            {

              $poids = $panier[$produit->getId()]['qte'] * ($produit->getPoids() + ($produit->getEpaiss() * 2 + $produit->getLargeur() *2 + $produit->getTaille() *2) * $poidsInt);
              $epaissMax = max( $epaissMax, $produit -> getEpaiss() + $epaissInt * 2);
              $largMax = max( $largMax, $produit -> getLargeur() + $epaissInt * 2);
              $tailleMax = max( $tailleMax, $produit -> getTaille() + $epaissInt * 2);
              $volmax +=  $panier[$produit -> getId()]['qte'] * (($produit -> getEpaiss() + 2*$epaissInt) * ($produit -> getLargeur() + 2*$epaissInt) * ($produit -> getTaille() + 2*$epaissInt));
              $sommeLarg += $sommeLarg + $panier[$produit->getId()]['qte'] * ($produit->getLargeur()+2*$epaissInt);
              $totalPoids += $poids;
            }

        /* calcul des paramètres utilisés pour le calcul des frais de port */
            if( $totalPoids < 500 ){$poidsEmb = $poidsEmb1; $epaissEmb = $epaissEmb1;}
            if($totalPoids >= 500 && $totalPoids < 5000){$poidsEmb = $poidsEmb2; $epaissEmb = $epaissEmb2;}
            if($totalPoids >= 5000){$poidsEmb = $poidsEmb3; $epaissEmb = $epaissEmb3;}
            $dim = round((($sommeLarg / (1-$tauxVide) + 2*$epaissEmb ) + ($tailleMax / (1-$tauxVide) + 2*$epaissEmb) + ($epaissMax / (1-$tauxVideEpais) + 2*$epaissEmb ))/10 ,2);
            $dim3 = pow($volmax / (1-$tauxVide) , 1.0/3) + 2*$epaissEmb ;
            //echo(' epaissMax='.$epaissMax.'<br/>');
            $epaissMax = $epaissMax/ (1-$tauxVideEpais) + 2*$epaissEmb;
            $totalPoids = $totalPoids + $poidsEmb*($dim3*$dim3*6);
            //echo(' epaissMax='.$epaissMax.'<br/>');
            if(strtolower($livraison['pays'] )=='france')
            {
                if($livraison['cp']  > 95000){$typPays=2;}
                else {$typPays=1;}
            }
            elseif(in_array(strtolower($livraison['pays'] ) ,$europe)){$typPays=3;}
            else {$typPays=4;}        
        
        /* Tarifs applicables */
            $em = $this->getDoctrine()->getManager();
            $tarifs = $em->getRepository('EcomBundle:Tarif')->findBy( 
                array('typPays' => $typPays,'annee' => '2017')
                );
            // 4 - Détermination des frais de ports applicables
            foreach($tarifs as $tarif)
            { 
                if(strtolower($tarif->getOrg()) == 'la poste' && $tarif->getMaxepais()<150 && $tarif->getMaxepais() > $epaissMax && $tarif->getMaxdim() > $dim)
                {                    
                    $frPort = $this->calculTarif($tarif, $totalPoids);
                    $frPort = $frPort + 0.4; // suivi 0.4 € 
                    $tabFrPort['petit']=array('organisme' => $tarif->getOrg(), 'nom' => $tarif->getNom(), 'img'=> $tarif->getImg(), 'frPort' => $frPort);
                    $tabFrPort['minI']=3; $tabFrPort['minF']=$frPort; 
                }
                elseif(strtolower($tarif->getOrg()) == 'la poste' && $tarif->getMaxepais()>150 )
                { 
                    $frPort = $this->calculTarif($tarif, $totalPoids);
                    $frPort = $frPort + 0; //  
                    $tabFrPort['colissimo']=array('organisme' => $tarif->getOrg(), 'nom' => $tarif->getNom(), 'img'=> $tarif->getImg(), 'frPort' => $frPort); 
                    if(($tabFrPort['minF']!=0 && $tabFrPort['minF']> $frPort) ||   $tabFrPort['minF'] == 0 )
                    {$tabFrPort['minI']=2; $tabFrPort['minF']=$frPort;}   
                }
                else
                { 
                    $frPort = $this->calculTarif($tarif, $totalPoids);
                    if($frPortA==0){
                        $frPortA=$frPort;
                    }
                    if($frPort <= $frPortA){
                        $frPortA = min($frPortA, $frPort);   
                        if(($tabFrPort['minF']!=0 && $tabFrPort['minF']> $frPortA) ||   $tabFrPort['minF'] == 0 )
                        {$tabFrPort['minI']=1; $tabFrPort['minF']=$frPortA;}          
                    } 
                    $tabFrPort['autre']=array('organisme' => $tarif->getOrg(), 'nom' => $tarif->getNom(), 'img'=> $tarif->getImg(), 'frPort' => $frPortA);               
                }
            } 
            //echo("<br/>ici, minI=".$tabFrPort['minI']." et minF=".$tabFrPort['minF'] );
            //var_dump($tabFrPort);
            //die();
            return $tabFrPort;      
    }
    private function calculTarif($tarif, $totalPoids)
    {
        if($totalPoids > $tarif->getP9()) $frPort = $tarif->getT10();
        else $frPort = $tarif->getT9();
        if($totalPoids <= $tarif->getP8()) $frPort = $tarif->getT8();
        if($totalPoids <= $tarif->getP7()) $frPort = $tarif->getT7();
        if($totalPoids <= $tarif->getP6()) $frPort = $tarif->getT6();
        if($totalPoids <= $tarif->getP5()) $frPort = $tarif->getT5();
        if($totalPoids <= $tarif->getP4()) $frPort = $tarif->getT4();
        if($totalPoids <= $tarif->getP3()) $frPort = $tarif->getT3();
        if($totalPoids <= $tarif->getP2()) $frPort = $tarif->getT2();
        if($totalPoids <= $tarif->getP1()) $frPort = $tarif->getT1();
        if($totalPoids <= $tarif->getP0()) $frPort = $tarif->getT0();
        $frPort = $frPort + 0.5; //  forfait 0.5 € 
        return $frPort;       
    }

   public function showcgvAction( Request $request)
   {
        // Affiche les CGV de l'entreprise vendeur dans un nouvel onglet
        $em = $this->getDoctrine()->getManager();  
        $id=1;
        $vendeur = $em->getRepository('AdBundle:Vendeur')->findOneById($id);
        return $this->render('PagesBundle:Default:pages/layout/cgv.html.twig', array( 'vendeur'=> $vendeur));   
   }
}
