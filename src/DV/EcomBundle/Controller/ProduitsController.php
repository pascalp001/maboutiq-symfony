<?php

namespace DV\EcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DV\EcomBundle\Form\RechercheType ;
use DV\EcomBundle\Entity\Categories;
use DV\EcomBundle\Form\AvisType ;
use DV\EcomBundle\Entity\Avis;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Security;

class ProduitsController extends Controller
{
    public function produitsAction(Request $request, Categories $categorie = null )
    {       
    	$em = $this->getDoctrine()->getManager();
        if($categorie != null)
            $findProduits = $em->getRepository('EcomBundle:Produits')->byCategorie($categorie);
        else
    	   $findProduits = $em->getRepository('EcomBundle:Produits')->findBy(array('disponible' => 1));  
        //page par défaut et nombre de produits par page :
        $produits  = $this->get('knp_paginator') ->paginate( $findProduits,  $request->query->get('page', 1), 5 );

        $session = $request->getSession();      
        if($session->has('panier')) 
            {$panier = $session->get('panier');}
        else{$panier=false;}

        return $this->render('EcomBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits, 'panier'=>$panier) );
    }

     public function presentationAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$produit = $em->getRepository('EcomBundle:Produits')->find($id);
    	if (!$produit) throw  $this->createNotFoundException('La page n\'existe pas'); 
        $popularite = $produit->getPopularite();
        $produit->setPopularite($popularite+1);
        $em->persist($produit);
        $em->flush();
        $session = $this->getRequest()->getSession();      
        if($session->has('panier')) 
            {$panier = $session->get('panier');}
        else{$panier=false;}
        return $this->render('EcomBundle:Default:produits/layout/presentation.html.twig', array('produit'=>$produit, 'panier'=>$panier) );
    }

     public function rechercheAction()
    {
        $form = $this->createForm(new RechercheType());
        return $this->render('EcomBundle:Default:Recherche/modulesUsed/recherche.html.twig', array('form'=>$form->createView() ));
    }
    
     public function rechercheTraitementAction(Request $request)
    {
        $form = $this->createForm(new RechercheType());
    	if ($request->getMethod() == 'POST')
    	{
    		$form->handleRequest($request);
    		$em = $this->getDoctrine()->getManager();
    		$produits = $em->getRepository('EcomBundle:Produits')->recherche($form['recherche']->getData());
    	}
    	else 
		{ 
			throw  $this->createNotFoundException('La page n\'existe pas'); 
		}
   		return $this->render('EcomBundle:Default:produits/layout/produits.html.twig', array('produits'=>$produits) );
    }

    public function indexAvisAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $avis = $em->getRepository('EcomBundle:Avis')->findBy(array('produit'=>$id,'valid'=>1));
        $stars=0; $addAvis = false;
        if (!$avis)
        {
            $nbavis = 0;
            $note = -1;
        }
        else
        {
            $nbavis = count($avis);
            foreach($avis as $avi)
            {
                $stars+=$avi->getStars();
            }
            $note = round($stars/$nbavis, 2);
        }

        return $this->render('EcomBundle:Default:produits/modulesUsed/indexAvis.html.twig', array('avis' => $avis, 'nbAvis' =>$nbavis, 'note'=> $note, 'addAvis'=>$addAvis));
    }

    public function listeAvisAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $avis = $em->getRepository('EcomBundle:Avis')->findBy(array('produit'=>$id,'valid'=>1));
         if (!$avis)
        {
            $nbavis = 0;
        }
        else
        {
            $nbavis = count($avis);
        }
        return $this->render('EcomBundle:Default:produits/modulesUsed/listeAvis.html.twig', array('avis' => $avis, 'nbAvis' =>$nbavis));
    }

    public function addAvisAction($id, Request $request)
    {
        $utilisateur = $this->container->get('security.token_storage')->getToken()->getUser();  
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('EcomBundle:Produits')->find($id);  

        $avis = new Avis();
        $form1 = $this->createForm(new AvisType, $avis);
        $form1->add('submit', SubmitType::class, array('label' => '+', 'attr'=>array('class'=>'btn btn-grosplus pull-right')));

        //Cas où on a déjà rentré un avis mémorisé en session :
        //$session = $request->getSession();
        //if (!$session->has('avis')) {$session->set('avis', array()); $aviss = null;}
        //else {$aviss = $session->get('avis');  }

        if ($request->getMethod() == 'POST')
        {            
            $form1->handleRequest($request);

            if($form1->isSubmitted() && $form1->isValid())
            {
                $avis->setUser($utilisateur);
                $avis->setProduit($produit);
                $avis->setDate(new \DateTime());
                $avis->setValid(0);
                //var_dump($avis);
                //die();
                $em = $this->getDoctrine()->getManager();
                $em->persist($avis);
                $em->flush();                 
                return $this->redirect($this->generateUrl('presentation', array('id'=>$id) ));           
            }
            return $this->redirect($this->generateUrl('presentation', array('id'=>$id))); 
        }

        return $this->render('EcomBundle:Default:produits/modulesUsed/avis.html.twig', array('id'=>$id,  'form1' => $form1->createView() ));
    }

}
