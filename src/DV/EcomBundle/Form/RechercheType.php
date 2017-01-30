<?php
namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder->add('recherche', 'text', array('label'=>false, 'attr'=> array('class'=>'form-control', 'placeholder'=>'Rechercher', 'style'=>'color:#132; line-height: 20px; font-size: 15px;')));
	}
    public function getName()
      {
          return 'ecom_ecombundle_recherche'; // Syntaxe particulière : minuscules et underscores
      }

}
?>