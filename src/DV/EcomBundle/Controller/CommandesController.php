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
use DV\EcomBundle\Entity\Vendeur;

class CommandesController extends Controller
{
  public function facture(Request $request)
  {
    // 1 - Récupération des différents morceaux : adresses de facturation et livraison, panier, frais de port    
    $em = $this->getDoctrine()->getManager();  
    $generator = $this->container->get('security.secure_random'); //va cr�er un token al�atoire
    $session = $request->getSession();
    $adresse = $session->get('adresse');
    $facturation = $em->getRepository('EcomBundle:UtilisateursAdresses')->find($adresse['facturation']);
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
      $choixFrPort = null; $org ="";$nom = ""; $frPort = 0;
    }

    $commande = array();
    $totalHT =0;
    $totalTVA = 0;

    foreach($produits as $produit)
    {
      $prixHT = ($produit->getPrix() * $panier[$produit->getId()]);
      $prixTTC = $prixHT * $produit->getTva()->getMultiplicate();
      $totalHT += $prixHT;

      if (!isset($commande['tva']['%'.$produit->getTva()->getValeur()]))
        $commande['tva']['%'.$produit->getTva()->getValeur()] = round($prixTTC - $prixHT, 2);
      else
        $commande['tva']['%'.$produit->getTva()->getValeur()] += round($prixTTC - $prixHT, 2);

      $totalTVA += round($prixTTC - $prixHT,2);  
        
      $commande['produit'][$produit->getId()] = array('reference' => $produit->getNom(),
                                                       'quantite' => $panier[$produit->getId()],
                                                         'prixHT' => round($produit->getPrix(),2),
                                                        'prixTTC' => round($produit->getPrix()*$produit->getTva()->getMultiplicate(),2));
    }
      $commande['livraison'] = array('prenom'=> $livraison->getPrenom(), 'nom'=> $livraison->getNom(), 'telephone'=> $livraison->getTelephone(),'adresse'=> $livraison->getAdresse(), 'cp'=> $livraison->getCp(), 'ville'=> $livraison->getVille(), 'pays'=> $livraison->getPays(), 'complement'=> $livraison->getComplement());
      $commande['facturation'] = array('prenom'=> $facturation->getPrenom(), 'nom'=> $facturation->getNom(), 'telephone'=> $facturation->getTelephone(),'adresse'=> $facturation->getAdresse(), 'cp'=> $facturation->getCp(), 'ville'=> $facturation->getVille(), 'pays'=> $facturation->getPays(), 'complement'=> $facturation->getComplement());
    $commande['totalHT'] = round($totalHT,2);
    $commande['org'] = $org;
    $commande['nom'] = $nom;
    $commande['frPort'] = $frPort;
    $commande['totalTTC'] = round($totalHT+$totalTVA+$frPort,2);

      
    $commande['token'] = bin2hex($generator->nextBytes(20)); //g�n�ration token al�atoire

    return $commande;
  }

  public function prepareCommandeAction(Request $request)
  {
      $session = $request->getSession();
      $em = $this->getDoctrine()->getManager();
      if (!$session->has('commande'))  { $commande = new Commandes();}
      elseif($em->getRepository('EcomBundle:Commandes')->find($session->get('commande'))) 
      {
       $commande = $em->getRepository('EcomBundle:Commandes')->find($session->get('commande'));
      }
      else { $commande = new Commandes();}

      //On prépare la commande :
      $commande->setUtilisateur($this->container->get('security.token_storage')->getToken()->getUser());
      $commande->setDate(new \DateTime());
      $commande->setPayer(0);
      $commande->setModpmt(0);
      $commande->setValider(0);
      $commande->setPreparer(0);
      $commande->setLivrer(0);
      $commande->setArchiver(0);
      $commande->setReference(0); //On initialise la référence à 0, mais un service va déterminer le numéro de commande
      //Commande.commande va contenir le panier, les frais de port, le total HT et TTC, de manière non relationnelle :
      $commande->setCommande($this->facture($request)); 

       if (!$session->has('commande')){
          $em->persist($commande);
          $session->set('commande',$commande);
       }

       $em->flush();

       return new Response($commande->getId());
  }

  public function paiementAction($id, Request $request)
  {
    // Vers le choix du mode de paiement
    $session = $request->getSession();
    $showboite = false; $idv=1;
    $em = $this->getDoctrine()->getManager();
    $commande = $em->getRepository('EcomBundle:Commandes')->find($id);    
    $vendeur = $em->getRepository('EcomBundle:Vendeur')->findOneById($idv);

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

          //On actualise la commande "supposée validée" avec un numéro de commande / facturation :         
          $commande->setReference($this->container->get('setNewReference')->reference());
          $em->persist($commande);
          $em->flush();   

          // Si règlement fait par CB ou Paypal, ... :
          if($donnees['modbq'] == 1 )  {
           return $this->render('EcomBundle:Default:panier/layout/apiBanque.html.twig', array('commande' => $commande, 'vendeur'=> $vendeur));}
           //->redirect($this->generateUrl('apiBanque')); 
          elseif($donnees['modbq'] == 2 )  { 
            return $this->render('EcomBundle:Default:panier/layout/apiPaypal.html.twig', array('commande' => $commande, 'vendeur'=> $vendeur));}
            //->redirect($this->generateUrl('apiPaypal')); } 
          elseif($donnees['modbq'] == 3 || $donnees['modbq'] == 4) {  return $this->redirect($this->generateUrl('validationCommande')); } 
          else{ return $this->redirect($this->generateUrl('paiement')); } 
        }
         return $this->redirect($this->generateUrl('paiement')); 
      }
    // Affichage de la page choix du mode de paiement et de son formulaire :
    return $this->render('EcomBundle:Default:panier/layout/paiement.html.twig', array('commande' => $commande, 'showboite'=> $showboite, 'vendeur'=> $vendeur, 'form' => $form->createView() ));
  }

  /*
   * Cette méthode simule le règlement via l'api banque
   */
  public function apiBanqueAction($id, Request $request)
  {    
    $em = $this->getDoctrine()->getManager();
    $commande = $em->getRepository('EcomBundle:Commandes')->find($id);
    $vendeur = $em->getRepository('EcomBundle:Vendeur')->find(1);
    return $this->render('EcomBundle:Default:panier/layout/apiBanque.html.twig', array('commande' => $commande, 'vendeur'=> $vendeur));     
  }
  /*
   * Cette méthode simule le règlement via l'api Paypal
   */
  public function apiPaypalAction($id, Request $request)
  {    
    $em = $this->getDoctrine()->getManager();
    $commande = $em->getRepository('EcomBundle:Commandes')->find($id);
    $vendeur = $em->getRepository('EcomBundle:Vendeur')->find(1);
    return $this->render('EcomBundle:Default:panier/layout/apiPaypal.html.twig', array('commande' => $commande, 'vendeur'=> $vendeur));     
  }

    /*
     * Cette méthode se place après le règlement via l'api banque/paypal
     */
    public function validationCommandeAction($id, Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      
      // Commande validée :
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
      $message = \Swift_Message::newInstance()
              ->setSubject('Validation de votre commande')
              ->setFrom(array('pascal.p8610@gmail.com'=>"ProG-dev"))
              ->setTo($commande->getUtilisateur()->getEmailCanonical())
              ->setCharset('utf-8')
              ->setContentType('text/html')
              ->setBody($this->renderView('EcomBundle:Default:SwiftLayout/validCommande.html.twig', 
                array('utilisateur'=> $commande->getUtilisateur())));
      $this->get('mailer')->send($message);

      // Message "succès" :
      $this->get('session')->getFlashBag()->add('success', 'Votre commande est validée avec succès');

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


