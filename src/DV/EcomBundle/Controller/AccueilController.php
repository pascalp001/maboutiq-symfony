<?php

namespace DV\EcomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DV\EcomBundle\Entity\Message;
use DV\EcomBundle\Form\MessageType;

class AccueilController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
        $table=array(); $ind=array();
    	$vendeur = $em->getRepository('AdBundle:Vendeur')->find(1);
    	$promoProds = $em->getRepository('EcomBundle:PromoProds')->findAllPromoProdProd();
        $articles = $em->getRepository('EcomBundle:Article')->findArticles();
        $p = count($promoProds); $j=0;
        $a = count($articles);
        //echo '$p='.$p.' ; $a='.$a;
        for($i =0; $i<$a+$p; $i++)
        {
            $j = rand(0,100);

            while ( in_array($j, $ind) )
            {
                $j = rand(0,100);
            }
            
            if( !in_array($j, $ind)) $ind[$i] = $j;

    	} 
        //var_dump($ind); die();
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


    public function nouscontacterAction(Request $request)
    {
        $msg = new Message();
        $form = $this->createCreateForm($msg);
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $titre = $msg->getTitre();
            $content = $msg->getContent();
            $email = $msg->getEmail();
            $tel = $msg->getTel();

            $Vendeur = $em->getRepository('AdBundle:Vendeur')->find('1');
            $message = \Swift_Message::newInstance()
                  ->setSubject($titre)
                  ->setFrom(array('pascal.p8610@gmail.com'=>"ProG-dev"))
                  ->setTo($Vendeur->getEmail())
                  ->setCharset('utf-8')
                  ->setContentType('text/html')
                  ->setBody($titre. '<br/>Message envoyé :<br/>'.$content.'<br/>Tel indiqué :'.$tel.'<br/>Email indiqué :'.$email.'<br/>Fin du message.');
        $this->get('mailer')->send($message);
        $this->get('session')->getFlashBag()->add('success', 'Votre message a été envoyé avec succès');
           return $this->redirect($this->generateUrl('envoi_message'));        
        }

        return $this->render('EcomBundle:Accueil:nouscontacter.html.twig', array( 'form' => $form->createView() ));
    } 

    private function createCreateForm(Message $msg)
    {
        $form = $this->createForm(MessageType::class, $msg, array(
            'action' => $this->generateUrl('envoi_message'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Envoyer ce message', 'attr'=>array('class'=>'btn btn-info')));

        return $form;
    } 
}
