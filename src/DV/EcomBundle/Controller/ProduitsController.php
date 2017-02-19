<?php

namespace DV\EcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DV\EcomBundle\Form\RechercheType ;
use DV\EcomBundle\Entity\Categories;

class ProduitsController extends Controller
{
    public function produitsAction(Request $request, Categories $categorie = null )
    {       
    	$em = $this->getDoctrine()->getManager();
        if($categorie != null)
            $findProduits = $em->getRepository('EcomBundle:Produits')->byCategorie($categorie);
        else
    	   $findProduits = $em->getRepository('EcomBundle:Produits')->findBy(array('disponible' => 1));  
        
        $produits  = $this->get('knp_paginator') ->paginate( $findProduits,  $request->query->get('page', 1), 3 );

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
    
     public function rechercheTraitementAction()
    {
        $form = $this->createForm(new RechercheType());
    	if ($this->get('request')->getMethod() == 'POST')
    	{
    		$form->bind($this->get('request'));
    		$em = $this->getDoctrine()->getManager();
    		$produits = $em->getRepository('EcomBundle:Produits')->recherche($form['recherche']->getData());
    	}
    	else 
		{ 
			throw  $this->createNotFoundException('La page n\'existe pas'); 
		}
   		return $this->render('EcomBundle:Default:produits/layout/produits.html.twig', array('produits'=>$produits) );
    }
}
