<?php

namespace DV\EcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use DV\EcomBundle\Form\UtilisateursAdressesType;
use DV\EcomBundle\Entity\UtilisateursAdresses;

class PanierController extends Controller
{
    public function menuAction(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));

        return $this->render('EcomBundle:Default:panier/modulesUsed/menu.html.twig', array('articles' => $articles));
    }

    public function panierAction(Request $request)
    {
        //Retourne un tableau contenant la liste des idProduit + quantité 
        $session = $request->getSession(); //$this->getRequest()->getSession();
        if (!$session->has('panier')) $session->set('panier', array()); 
        //else{var_dump($session->get('panier')); die();}

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcomBundle:Produits')->findArray(array_keys($session->get('panier')));  
        return $this->render('EcomBundle:Default:panier/layout/panier.html.twig', array('produits' => $produits, 'panier' => $session->get('panier')));
    }

    public function ajouterAction($id, Request $request)
    {
        //Rajoute s'il n'existe pas déjà ou met à jour un couple idProduit + quantité => $panier[$id] contient la quantité du produit
        $session =  $request->getSession(); //$this->getRequest()->getSession();//getRequest() est obsol?e=>Request $request inject?      
        if (!$session->has('panier')) $session->set('panier', array()); //equivaut à if(!isset($_SESSION['panier']))... on initialise à un tableau vide
        $panier = $session->get('panier');
        
        if (array_key_exists($id, $panier))
        {
            // ce produit existe déjà dans le panier...
            
            if ($request->query->get('qte') != null) $panier[$id] = $request->query->get('qte');
        }
        else
        {
            // ce produit n'existe pas encore dans le panier...
            
            if ($request->query->get('qte') != null)
            {    
                $panier[$id] = $request->query->get('qte');
            }
            else{
                $panier[$id] = 1; 
            }
        }
        $session->set('panier', $panier);
        
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
        } 
        return $this->redirect($this->generateUrl('panier'));
    }

       public function adresseSuppressionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EcomBundle:UtilisateursAdresses')->find($id)  ;    
        //On vérifie que c'est bien l'utilisateur qui supprime son adresse :
        if ($this->container->get('security.context')->getToken()->getUser() != $entity->getUtilisateur() || !$entity)
        {
            return ($this->redirect($this->generateUrl('adresses')));
        }
        $em->remove($entity);
        $em->flush();
        return ($this->redirect($this->generateUrl('adresses')));
    }

       public function adressesAction(Request $request)
    {
        //Ajoute une adresse de livraison dans utilisateur
        $utilisateur = $this->container->get('security.context')->getToken()->getUser();
           // var_dump($utilisateur);
           // die();          
        $entity = new UtilisateursAdresses();
        $form = $this->createForm(new UtilisateursAdressesType, $entity);
        if($this->get('request')->getMethod() == "POST")
        { 
            
            $form->handleRequest($request); //On récupère le formulaire en cours
            
            
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $entity->setUtilisateur($utilisateur);
              
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('adresses'));
            }
            //else{echo'sol';}

        }     
        return $this->render('EcomBundle:Default:panier/layout/adresses.html.twig', array('utilisateur'=>$utilisateur, 'form'=>$form->createView()));
    }

       public function setLivraisonOnSession( Request $request)
    {
        //Place adresse de facturation et adresse de livraison en session - retour à validationAction
        $session = $request->getSession();
        if (!$session->has('adresse')) $session->set('adresse', array()); 
        $adresse = $session->get('adresse');  
        // on v?ifie le renvoi des "POST" :
        if( $request->request->get('livraison') != null &&  $request->request->get('facturation') != null )
        {
            $adresse['livraison'] = $request->request->get('livraison');
            $adresse['facturation'] = $request->request->get('facturation');
        }  
        else
        {
             return $this->redirect($this->generateUrl('validation'));
        } 
        $session->set('adresse', $adresse);  

        return $this->redirect($this->generateUrl('validation'));
    }

       public function validationAction( Request $request)
    {
        //Récupère une commande enregistrée et la retourne vers validation.html.twig
        if($this->get('request')->getMethod() == "POST")
            $this->setLivraisonOnSession($request);
		
        $em = $this->getDoctrine()->getManager();
        $prepareCommande = $this->forward('EcomBundle:Commandes:prepareCommande');
        $commande = $em->getRepository('EcomBundle:Commandes')->find($prepareCommande->getContent());

        return $this->render('EcomBundle:Default:panier/layout/validation.html.twig',
        		array('commande' => $commande));
       }

}
