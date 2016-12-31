<?php

namespace DV\EcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PanierController extends Controller
{
    public function panierAction()
    {
        return $this->render('EcomBundle:Default:panier/layout/panier.html.twig');
    }
       public function livraisonAction()
    {
        return $this->render('EcomBundle:Default:panier/layout/livraison.html.twig');
    }

       public function validationAction()
    {
        return $this->render('EcomBundle:Default:panier/layout/validation.html.twig');
    }

}
