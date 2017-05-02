<?php
namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AvisType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder->add('stars', HiddenType::class, array('label'=>false, 'attr'=> array('class'=>'rate')))
				->add('titre', TextType::class, array('label'=>false, 'attr'=> array('class'=>'form-control', 'placeholder'=>'Un titre à votre avis', 'style'=>'color:#132; line-height: 20px; font-size: 15px; font-weight: 800;')))
				->add('comment', TextareaType::class, array('label'=>false, 'attr'=> array('class'=>'form-control ', 'placeholder'=>'Votre avis...', 'style'=>'color:#132; line-height: 20px; font-size: 15px; font-style:italic;')))
            	;
	}
    public function getBlockPrefix()
      {
          return 'dv_ecombundle_avis'; 
      }

}
?>