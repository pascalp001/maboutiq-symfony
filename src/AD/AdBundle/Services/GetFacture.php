<?php
namespace AD\AdBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class GetFacture
{
	public function __construct(ContainerInterface $container)
	{

		$this->container = $container;
	}

	public function facture($facture)
	{
		$html = $this->container->get('templating')->render('UtilisateursBundle:Default:layout/facturePDF.html.twig', array('facture' => $facture));
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