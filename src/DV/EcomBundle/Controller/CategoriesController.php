<?php

namespace DV\EcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function menuAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$categories = $em->getRepository('EcomBundle:Categories')->findAll();
        return $this->render('EcomBundle:Default:categories/modulesUsed/menu.html.twig', array('categories'=>$categories));
    }

}
