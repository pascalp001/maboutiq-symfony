<?php

namespace DV\EcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use DV\EcomBundle\Form\UtilisateursAdressesType;
use DV\EcomBundle\Entity\UtilisateursAdresses;
use DV\EcomBundle\Entity\Commandes;
use DV\EcomBundle\Entity\Produits;
use AD\AdBundle\Entity\Vendeur;

class CommandesController extends Controller
{
  public function validationAction( Request $request)
  {
      // On prépare la commande finale (mise en base de données et en session) en vue de la validation :
      $em = $this->getDoctrine()->getManager(); 
      $prepareCommande = $this->prepareCommandeAction($request);//forward('EcomBundle:Commandes:prepareCommande', array('request'=> $request));
      $session = $request->getSession();      
      $commande = $em->getRepository('EcomBundle:Commandes')->find($prepareCommande->getContent());

      return $this->render('EcomBundle:Default:panier/layout/validation.html.twig',
          array('commande' => $commande));
      // La suite des actions se passe dans CommandesController.php via routingCommande.yml :
      // paiementAction permet le choix du mode de paiement et affiche paiement.html.twig
      // Choix 1 (CB banque) et 2 (Paypal) : accès à l'API externe correspondant ; envoi id vendeur+id commande+TTC+date ; réception OK ; payer = 1 ;
      // Choix 3 (virement) et 4 (chèque) : rien (payer reste à 0)
      // validationCommandeAction valide la commande complète, efface les données de la commande en session, envoie un mail, envoie un message 'succès', redirige vers paiementfaitAction
      // paiementfaitAction affiche les commandes du client et paiementfait.html.twig (avant retour boutique) ; affiche statut paiement 'en attente' si virement ou chèque
 }

  public function prepareCommandeAction(Request $request)
  {
      // Dans cette étape, un objet commande est créé au début ; 
      // à la fin, si tout s'est bien passé, l'id de la commande est mis en session
      $session = $request->getSession();
      $em = $this->getDoctrine()->getManager();

      //echo '<pre>';var_dump($session);echo '</pre>';
      //die();
      //Création de l'objet commande si l'id n'et pas déjà en session :
      if (!$session->has('commande') || null===$session->get('commande'))  { $commande = new Commandes();}
      elseif($em->getRepository('EcomBundle:Commandes')->find($session->get('commande'))) 
      {
       $commande = $em->getRepository('EcomBundle:Commandes')->find($session->get('commande'));
      }
      else { $commande = new Commandes();}

      //On prépare la commande :      
      $commande->setDate(new \DateTime());
      $commande->setReference(0); //On initialise la référence à 0, mais un service va déterminer le numéro de commande      
      //Commande.commande va contenir le panier, les frais de port, le total HT et TTC, de manière non relationnelle :
      $commande->setCommande($this->facture($request));       
      $commande->setPayer(0);
      $commande->setModpmt(0);
      $commande->setValider(0);
      $commande->setPreparer(0);
      $commande->setLivrer(0);
      $commande->setArchiver(0);

      $commande->setUtilisateur($this->container->get('security.token_storage')->getToken()->getUser());

      // On enregistre commande en base de donnée et l'id est mis en session :
      if (!$session->has('commande')|| null===$session->get('commande')){
        $em->persist($commande);       
      }

       $em->flush();
       $session->set('commande', $commande->getId());

      //Retour à validationAction
      return new Response($commande->getId());
  }
  
  public function facture(Request $request)
  {
    // 1 - Récupération des différents morceaux : adresses de facturation et livraison, panier, frais de port    
    $em = $this->getDoctrine()->getManager();  
    $generator = $this->container->get('security.secure_random'); //va cr�er un token al�atoire
    $session = $request->getSession();
    $adresse = $session->get('adresse');
    $Facturation = $em->getRepository('EcomBundle:UtilisateursAdresses')->find($adresse['facturation']);
    $livraison = $session->get('livraison');
    $panier = $session->get('panier');

    $produits =  $em->getRepository('EcomBundle:Produits')->findArray(array_keys($session->get('panier')));
    $tabFrPort = $session->get('tabFrPort');
    
    if(array_key_exists('choix',$tabFrPort)) 
    {
      $choixFrPort = $tabFrPort['choix'];
      $org = $tabFrPort['choix']['organisme']; 
      $nom = $tabFrPort['choix']['nom']; 
      $frPort = $tabFrPort['choix']['frPort'];
    } 
    else 
    {
      $choixFrPort = null; $org =""; $nom = ""; $frPort = 0;
    }

    $commande = array();
    $totalHT =0;
    $totalTVA = 0;

    foreach($produits as $produit)
    {
      $prixHT = ( $panier[$produit->getId()]['prix'] * $panier[$produit->getId()]['qte']);
      $prixTTC = $prixHT * $produit->getTva()->getMultiplicate();
      $totalHT += $prixHT;

      if (!isset($commande['tva']['%'.$produit->getTva()->getValeur()]))
        $commande['tva']['%'.$produit->getTva()->getValeur()] = round($prixTTC - $prixHT, 2);
      else
        $commande['tva']['%'.$produit->getTva()->getValeur()] += round($prixTTC - $prixHT, 2);

      $totalTVA += round($prixTTC - $prixHT,2);  
        
      $commande['produit'][$produit->getId()] = array('reference' => $produit->getNom(),
                                                       'quantite' => $panier[$produit->getId()]['qte'],
                                                         'prixHT' => round( $panier[$produit->getId()]['prix'],2),
                                                        'prixTTC' => round( $panier[$produit->getId()]['prix']*$produit->getTva()->getMultiplicate(),2));
    }
    
    $commande['livraison'] = array('prenom'=> $livraison['prenom'], 'nom'=> $livraison['nom'], 'telephone'=> $livraison['telephone'],'adresse'=> $livraison['adresse'], 'cp'=> $livraison['cp'], 'ville'=> $livraison['ville'], 'pays'=> $livraison['pays'], 'complement'=> $livraison['complement']);
    $commande['facturation'] = array('prenom'=> $Facturation->getPrenom(), 'nom'=> $Facturation->getNom(), 'telephone'=> $Facturation->getTelephone(),'adresse'=> $Facturation->getAdresse(), 'cp'=> $Facturation->getCp(), 'ville'=> $Facturation->getVille(), 'pays'=> $Facturation->getPays(), 'complement'=> $Facturation->getComplement());
    $commande['totalHT'] = round($totalHT,2);
    $commande['org'] = $org;
    $commande['nom'] = $nom;
    $commande['frPort'] = $frPort;
    $commande['totalTTC'] = round($totalHT+$totalTVA+$frPort,2);

      
    $commande['token'] = bin2hex($generator->nextBytes(20)); //g�n�ration token al�atoire

    return $commande;
  }

  public function paiementAction(Request $request)
  {
    // Vers le choix du mode de paiement
    $session = $request->getSession();
      //echo '<pre>';var_dump($session);echo '</pre>';
      //die();
    if (!$session->has('commande')|| null===$session->get('commande')){
      //echo '<pre>';var_dump($session);echo '</pre>';
      // Retour en arrière avant la validation et la création de l'objet commande - panier, adresses et frais de port sont encore en session
      return $this->redirect($this->generateUrl('validation'));             
    }
    $id = $session->get('commande');
    $showboite = false; $idv=1;

    // Mise à jour du stock virtuel :
    $panier = $session->get('panier');
    $em = $this->getDoctrine()->getManager();  
    $produits =  $em->getRepository('EcomBundle:Produits')->findArray(array_keys($session->get('panier')));
    foreach($produits as $produit)
    {   
      $stockvirtuel = $produit->getStockvirtuel() - $panier[$produit->getId()]['qte'];
      $produit->setStockvirtuel($stockvirtuel);
      $em->persist($produit);
    }    
    $em->flush();
   
    $em = $this->getDoctrine()->getManager();
    $commande = $em->getRepository('EcomBundle:Commandes')->find($id);    
    $vendeur = $em->getRepository('AdBundle:Vendeur')->findOneById($idv);

    $buildform = $this->createFormBuilder();
    $buildform->add('modbq', HiddenType::class, array('label'=>false, 'attr'=> array('class'=>'modbq', 'value'=>'1')))
              ->add('submit', SubmitType::class, array('label' => 'Payer la commande', 'attr'=>array('class'=>'btn btn-info pull-right', 'style'=>'color:#fff; font-weight:600;')));
    $form = $buildform->getForm();

    // On récupère le choix du mode de paiement
            
    if($request->getMethod() == "POST")
      {  
        $form->handleRequest($request);                               
        if($form->isSubmitted() && $form->isValid())
        {         
          // On récupère le choix du mode de paiement et la commande correspondante :
          $donnees = $form->getData();            
          $em = $this->getDoctrine()->getManager();
          $commande = $em->getRepository('EcomBundle:Commandes')->find($id);
          if(!$commande || $commande->getValider() == 1) throw $this->createNotFoundException('La commande n\'existe pas');

          // On conserve en base de données le choix du mode de paiement :
          $commande->setModpmt($donnees['modbq']);

          //On actualise la commande "supposée certaine à ce stade (vente réalisée)" avec un numéro de commande / facturation :         
          $commande->setReference($this->container->get('setNewReference')->reference());
          $em->persist($commande);
          $em->flush();  

          $montant =  $commande->getCommande()['totalTTC'];

          // Si règlement fait par CB ou Paypal, ... :
          if($donnees['modbq'] == 1 )  
          {
            return $this->render('EcomBundle:Default:panier/layout/apiBanque.html.twig', array('montant' => $montant, 'vendeur'=> $vendeur));
          }
          elseif($donnees['modbq'] == 2 )  
          { 
            return $this->render('EcomBundle:Default:panier/layout/apiPaypal.html.twig', array('montant' => $montant, 'vendeur'=> $vendeur));
          }
          elseif($donnees['modbq'] == 3 || $donnees['modbq'] == 4) 
          {
            return $this->redirect($this->generateUrl('validationCommande', array('request'=>$request))); 
          } 
          else
          { 
            return $this->redirect($this->generateUrl('paiement')); 
          } 
        }
        return $this->redirect($this->generateUrl('paiement')); 
      }
    // Affichage de la page choix du mode de paiement et de son formulaire :
    return $this->render('EcomBundle:Default:panier/layout/paiement.html.twig', array('commande' => $commande, 'showboite'=> $showboite, 'vendeur'=> $vendeur, 'form' => $form->createView() ));
  }



    /*
     * Cette méthode se place après le règlement via l'api banque/paypal
     */
    public function validationCommandeAction( Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      
      // Commande validée :
      $session = $request->getSession();
      if (!$session->has('commande')|| null===$session->get('commande')){
        // Erreur d'exécution : retour en arrière avant la validation et la création de l'objet commande - validation devenue impossible
      $session->remove('panier');
      $session->remove('adresse');
      $session->remove('livraison');
      $session->remove('tabFrPort');     
      $session->remove('commande');
            // Message "erreur" :
      $this->get('session')->getFlashBag()->add('error', 'Une erreur malencontreuse est survenue. Votre commande n\'a pas pu être enregistrée correctement. Un message vous sera envoyé prochainement pour vous indiquer si la commande a bien pu être enregistrée ou non, et si le paiement a été reçu ou non. ');
      //echo('ici');die();
        return $this->redirect($this->generateUrl('paiementfait'));             
      }
      $id = $session->get('commande');
      $commande = $em->getRepository('EcomBundle:Commandes')->find($id);
      $commande->setValider(1); 

      // Si règlement fait par CB ou Paypal, payer = 1 :
      if($commande->getModpmt() == 1 || $commande->getModpmt() == 2) $commande->setPayer("1");

      // Mise à jour de la commande :
      $em->persist($commande);
      $em->flush();  

      // On nettoie la session :
      $session = $request->getSession();      
      $session->remove('panier');
      $session->remove('adresse');
      $session->remove('livraison');
      $session->remove('tabFrPort');     
      $session->remove('commande');
      $paiement=true;
      $session->set('paiement', $paiement);

      // Mail de validation :
      $Vendeur = $em->getRepository('AdBundle:Vendeur')->find('1');
      $logo1 = $Vendeur->getUrllogo1();
      $vendeur = $Vendeur->getNomcomplet();
      $message = \Swift_Message::newInstance()
              ->setSubject('Validation de votre commande')
              ->setFrom(array('pascal.p8610@gmail.com'=>"ProG-dev"))
              ->setTo($commande->getUtilisateur()->getEmailCanonical())
              ->setCharset('utf-8')
              ->setContentType('text/html')
              ->setBody($this->renderView('EcomBundle:Default:SwiftLayout/validCommande.html.twig', 
                array('logo1'=>$logo1, 'vendeur'=>$vendeur,'commande'=> $commande)));
      $this->get('mailer')->send($message);

      // Message "succès" :
      $this->get('session')->getFlashBag()->add('success', 'Votre commande est validée avec succès');
      //echo('làla'); die();
      // Redirection vers la liste des commandes du client et le statut, via paiementfaitAction
      return $this->redirect($this->generateUrl('paiementfait'));
    }

    public function paiementfaitAction()
    {
    $em = $this->getDoctrine()->getManager();
    $commandes = $em->getRepository('EcomBundle:Commandes')->findByFacture($this->getUser(), array('id' => 'desc'))  ; 

    return $this->render('EcomBundle:Default:panier/layout/paiementfait.html.twig', array('commandes' => $commandes));
    }
}


