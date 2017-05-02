<?php
namespace AD\AdBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class GetCgv
{
	public function __construct(ContainerInterface $container)
	{

		$this->container = $container;
	}

	public function showCgv($vendeur)
	{
		$html = $this->container->get('templating')->render('PagesBundle:Default:pages/layout/cgvPDF.html.twig', array( 'vendeur'=>$vendeur));
        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        $html2pdf->pdf->SetAuthor('ProG-developpement IT');
        $html2pdf->pdf->SetTitle('Conditions Générales de Vente '.$vendeur->getNomcomplet());
        $html2pdf->pdf->SetSubject('Conditions Générales de Vente '.$vendeur->getNomcomplet());
        $html2pdf->pdf->SetKeywords('Conditions Générales de Vente, cgv , e-commerce, ProG-developpement IT');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html); 
     
        return new Response($html2pdf->Output('Cgv.pdf'), 200, array('Content-type'=> 'application/pdf') );
	}
}