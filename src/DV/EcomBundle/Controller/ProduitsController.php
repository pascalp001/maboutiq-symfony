<?php

namespace DV\EcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitsController extends Controller
{
    public function produitsAction()
    {
        return $this->render('EcomBundle:Default:produits/layout/produits.html.twig');
    }

     public function presentationAction($id)
    {
        return $this->render('EcomBundle:Default:produits/layout/presentation.html.twig', array('id'=>$id) );
    }

}
