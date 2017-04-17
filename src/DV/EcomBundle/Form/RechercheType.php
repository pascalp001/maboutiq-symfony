<?php
namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RechercheType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder->add('recherche', TextType::class, array('label'=>false, 'attr'=> array('class'=>'form-control', 'placeholder'=>'Rechercher')));
	}
    public function getBlockPrefix()
      {
          return 'ecom_ecombundle_recherche'; 
      }

}
?>