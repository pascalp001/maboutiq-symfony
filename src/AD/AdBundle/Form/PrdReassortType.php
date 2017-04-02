<?php
namespace AD\AdBundle\Form;

use AD\AdBundle\Entity\PrdReassort;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PrdReassortType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder->add('id', HiddenType::class)
				->add('nom', HiddenType::class)
				->add('cmdeP1', HiddenType::class)
				->add('cmdeP2', HiddenType::class)
				->add('cmdeP3', HiddenType::class)
				->add('cmdeP4', HiddenType::class)
				->add('cmdeP5', HiddenType::class)
				->add('cmdeP6', HiddenType::class)
				->add('cmdeP7', HiddenType::class)
				->add('cmdeP8', HiddenType::class)
				->add('cmdeP9', HiddenType::class)
				->add('cmdeP10', HiddenType::class)
				->add('cmdeP11', HiddenType::class)
				->add('cmdeP12', HiddenType::class)
				->add('cmdeV1', HiddenType::class)
				->add('cmdeV2', HiddenType::class)
				->add('cmdeV3', HiddenType::class)
				->add('cmdeV4', HiddenType::class)
				->add('cmdeV5', HiddenType::class)
				->add('cmdeV6', HiddenType::class)
				->add('cmdeV7', HiddenType::class)
				->add('cmdeV8', HiddenType::class)
				->add('cmdeV9', HiddenType::class)
				->add('cmdeV10', HiddenType::class)
				->add('cmdeV11', HiddenType::class)
				->add('cmdeV12', HiddenType::class)
				->add('cmdeV', HiddenType::class)
				->add('popularite', HiddenType::class)
				->add('stockreel', HiddenType::class)
				->add('reassort', NumberType::class, array('label'=>false,  'attr'=> array('value'=>'0','class'=>'form-control', 'style'=>'width:70px; cursor:pointer')))
				->add('stockvirtuel', HiddenType::class)
				->add('stockvirtheo', HiddenType::class)
				->add('ajust', TextType::class, array('label'=>false, 'attr'=> array('class'=>'form-control')))
            	;
	}
    public function getName()
      {
          return 'ad_adbundle_prdreassort'; // Syntaxe particulière : minuscules et underscores
      }

    public function configureOptions(OptionsResolver $resolver)
    {  
    	$resolver->setDefaults(array( 'data_class' => PrdReassort::class, ) );
	}

}