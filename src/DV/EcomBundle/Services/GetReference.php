<?php
namespace DV\EcomBundle\Services;

//use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

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
		else {
			//var_dump($reference->getReference());
			//die();
			$ref = $reference->getReference();
			for($i=0;$i<8;$i++)
			{
				//Codage de la référence : [type client]:1 [année]:17 [mois]:03 [n° à 3 chiffres]: 004
				switch (strlen($ref))
				{
					case 1: $ref = "0".$ref;
					case 2: $ref = "0".$ref;
					case 3: $ref = date('m').$ref;
					case 5: $ref = date('y').$ref;
					case 7: $ref = "1".$ref;
				}
			}
			$ref = $ref+1;	//incrémentation

			return $ref; 
		}
	}
}