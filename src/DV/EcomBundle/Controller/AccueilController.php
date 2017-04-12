<?php

namespace DV\EcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$vendeur = $em->getRepository('AdBundle:Vendeur')->find(1);
    	$promoProds = $em->getRepository('EcomBundle:PromoProds')->findAllPromoProdProd();
        $articles = $em->getRepository('EcomBundle:Article')->findAll();
    	 
        return $this->render('EcomBundle:Accueil:index.html.twig', array('vendeur'=>$vendeur, 'promoProds'=>$promoProds, 'articles'=> $articles));
    }

    public function siteAction()
    {
        return $this->render('EcomBundle:Accueil:site.html.twig');
    }   
}
