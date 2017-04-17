<?php

namespace DV\EcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
        $table=array(); $ind=array();
    	$vendeur = $em->getRepository('AdBundle:Vendeur')->find(1);
    	$promoProds = $em->getRepository('EcomBundle:PromoProds')->findAllPromoProdProd();
        $articles = $em->getRepository('EcomBundle:Article')->findArticles();
        $p = count($promoProds);
        $a = count($articles);
        for($i =0; $i<$a+$p; $i++)
        {
            $j = rand(0,100);
            if( !in_array($j, $ind)) $ind[$i] = $j;
    	} 
        $i=0;
        while($i < $a+$p)
        {
            for( $pi=0; $pi<$p; $pi++)
            {
               $table[$ind[$i] ] = $promoProds[$pi];
               $i++;
            }

            for( $ai=0; $ai<$a; $ai++)
            {
                $table[$ind[$i] ] = $articles[$ai];
                $i++;
            }
            
        }
        //var_dump($ind); echo'<br/>';
        //var_dump($table); die();

        return $this->render('EcomBundle:Accueil:index.html.twig', array('vendeur'=>$vendeur, 'inds'=>$ind, 'table'=>$table));
        
    }

    public function siteAction()
    {
        return $this->render('EcomBundle:Accueil:site.html.twig');
    }   
}
