<?php
namespace DV\EcomBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class GetBL
{
	public function __construct(ContainerInterface $container)
	{

		$this->container = $container;
	}

	public function bonlivraison($facture)
	{
		$html = $this->container->get('templating')->render('UtilisateursBundle:Default:layout/bonlivraisonPDF.html.twig', array('facture' => $facture));
        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        $html2pdf->pdf->SetAuthor('ProG-developpement IT');
        $html2pdf->pdf->SetTitle('Bon de livraison '.$facture->getReference());
        $html2pdf->pdf->SetSubject('Bon de livraison  ProG-developpement IT');
        $html2pdf->pdf->SetKeywords('Bon de livraison , ProG-developpement IT');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html); 
     
        return new Response($html2pdf->Output('BL.pdf'), 200, array('Content-type'=> 'application/pdf') );
	}
}