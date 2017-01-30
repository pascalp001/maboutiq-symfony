<?php

namespace Utilisateurs\UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UtilisateursController extends Controller
{
    public function facturesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $factures = $em->getRepository('EcomBundle:Commandes')->findByFacture($this->getUser())  ; 

        return $this->render('UtilisateursBundle:Default:layout/factures.html.twig', array('factures' => $factures));
    }

     public function facturePDFAction($id)
     {
        $em = $this->getDoctrine()->getManager();
        //on récupère la  facture de $id en vérifiant que c'est bien le bon utilisateur et que valider=1 :	
        $facture = $em->getRepository('EcomBundle:Commandes')->findOneBy(array('utilisateur' =>$this->getUser(),
        															'valider'=> 1,
        															 'id' => $id ) ) ; 
        if(!$facture){
        	$this->getFlashBag()->add('error', 'une erreur est survenue');
        	return $this->redirect($this->generateUrl('factures'));
        }

     	$html = $this->renderView('UtilisateursBundle:Default:layout/facturePDF.html.twig', array('facture' => $facture));
     	//$html = $this->container->get('templating')->render('UtilisateursBundle:Default:layout/facturePDF.html.twig', array('facture' => $facture));
        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        $html2pdf->pdf->SetAuthor('ProG-developpement IT');
        $html2pdf->pdf->SetTitle('Facture '.$facture->getReference());
        $html2pdf->pdf->SetSubject('Facture ProG-developpement IT');
        $html2pdf->pdf->SetKeywords('facture, ProG-developpement IT');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html); 
     
        return new Response($html2pdf->Output('Facture.pdf'), 200, array('Content-type'=> 'application/pdf') );
     }   
}
