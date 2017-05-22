<?php
namespace AD\AdBundle\Form;

use AD\AdBundle\Entity\PrdDemarque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
				->add('stockvirtuel', HiddenType::class)
				->add('casse', IntegerType::class, array('label'=>false,  'attr'=> array('value'=>'0','min'=>'0','class'=>'form-control', 'style'=>'width:100px; cursor:pointer')))
				->add('defect', IntegerType::class, array('label'=>false,  'attr'=> array('value'=>'0','min'=>'0','class'=>'form-control', 'style'=>'width:100px; cursor:pointer')))
				->add('autre', IntegerType::class, array('label'=>false,  'attr'=> array('value'=>'0','min'=>'0','class'=>'form-control', 'style'=>'width:100px; cursor:pointer')))
            	;
	}
    public function getBlockPrefix()
      {
          return 'ad_adbundle_prddemarque'; // Syntaxe particulière : minuscules et underscores
      }

    public function configureOptions(OptionsResolver $resolver)
    {  
    	$resolver->setDefaults(array( 'data_class' => PrdDemarque::class, ) );
	}

}