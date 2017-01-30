<?php
namespace DV\EcomBundle\Services;

use Symfony\Component\Security\Core\SecurityContextInterface;

class GetReference 
{
	public function __construct($securityContext, $entityManager)
	{

		$this->securityContext = $securityContext;
		$this->em = $entityManager;
	}

	public function reference()
	{
		$reference = $this->em->getRepository('EcomBundle:Commandes')->findOneBy(array('valider'=>1), array('id'=> 'DESC') ,1 ,1); //1 seul élément
		if (!$reference) return 1; //si pas encore de facture, la référence est 1
		else return $reference->getReference() + 1; //incrémentation
	}
}