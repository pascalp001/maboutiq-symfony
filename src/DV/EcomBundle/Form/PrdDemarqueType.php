<?php
namespace DV\EcomBundle\Form;

use DV\EcomBundle\Entity\PrdDemarque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PrdDemarqueType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder->add('id', HiddenType::class)
				->add('nom', HiddenType::class)
				->add('stockreel', HiddenType::class)
				->add('demarque', NumberType::class, array('label'=>false,  'attr'=> array('value'=>'0','class'=>'form-control', 'style'=>'width:70px; cursor:pointer')))
				->add('inventaire', TextType::class, array('label'=>false, 'attr'=> array('class'=>'form-control')))
            	;
	}
    public function getName()
      {
          return 'dv_ecombundle_prddemarque'; // Syntaxe particulière : minuscules et underscores
      }

    public function configureOptions(OptionsResolver $resolver)
    {  
    	$resolver->setDefaults(array( 'data_class' => PrdDemarque::class, ) );
	}

}