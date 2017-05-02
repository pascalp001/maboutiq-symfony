<?php
namespace AD\AdBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class GetReassort
{
	public function __construct(ContainerInterface $container)
	{

		$this->container = $container;
	}

	public function reassort($vendeur, $Produits, $Fournisseurs, $moistxt, $cad, $cadencierP, $cadencierV, $cmdesV, $moyVtes)
	{
		$content = $this->container->get('templating')->render('AdBundle:Administration:Stocks/layout/reassortPDF.html.twig', array( 'vendeur'=>$vendeur, 'Produits' => $Produits,'Fournisseurs'=>$Fournisseurs,'moistxt'=>$moistxt, 'cad' => $cad, 'cadencierP' => $cadencierP,'cadencierV' => $cadencierV, 'cmdesV'=> $cmdesV, 'moyVtes'=>$moyVtes));
        $html2pdf = new \Html2Pdf_Html2Pdf('L','A4','fr');
        $html2pdf->pdf->SetAuthor('ProG-developpement IT');
        $html2pdf->pdf->SetTitle('Reassort mois de '.$vendeur->getNomcomplet());
        $html2pdf->pdf->SetSubject('Reassort mois de '.$vendeur->getNomcomplet());
        $html2pdf->pdf->SetKeywords('Cadencier des ventes, resaaort fournisseur, e-commerce, ProG-developpement IT');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($content); 
     
        return new Response($html2pdf->Output('Reassort.pdf'), 200, array('Content-type'=> 'application/pdf') );
	}
}