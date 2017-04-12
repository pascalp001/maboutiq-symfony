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
    	 
        return $this->render('EcomBundle:Accueil:index.html.twig', array('vendeur'=>$vendeur, 'promoProds'=>$promoProds));
    }

    public function siteAction()
    {
        return $this->render('EcomBundle:Accueil:site.html.twig');
    }   
}
