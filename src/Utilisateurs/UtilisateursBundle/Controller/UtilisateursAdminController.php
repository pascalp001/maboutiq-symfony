<?php

namespace Utilisateurs\UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Utilisateurs\UtilisateursBundle\Entity\Client;

class UtilisateursAdminController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $result=array();
       
        $id0=1;
        $utilisateurs = $em->getRepository('UtilisateursBundle:Utilisateurs')->findAll()  ; 
        //var_dump($utilisateurs);
        //die();
        return $this->render('UtilisateursBundle:Administration:Utilisateurs/layout/index.html.twig', array('utilisateurs' => $utilisateurs));
    }

    public function utilisateurAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('UtilisateursBundle:Utilisateurs')->find($id); 
        $route = $this->container->get('request')->get('_route'); //on récupère cet attribut par un var_dump($this->container->get('request')) préalable
        if( $route == 'adminAdressesUtilisateurs') 
            return $this->render('UtilisateursBundle:Administration:Utilisateurs/layout/adresses.html.twig', array('utilisateur' => $utilisateur));
        elseif( $route == 'adminFacturesUtilisateurs') 
            return $this->render('UtilisateursBundle:Administration:Utilisateurs/layout/factures.html.twig', array('utilisateur' => $utilisateur));
        else
            throw $this->createNotFoundException('La vue n\'existe pas');
    }   
}
