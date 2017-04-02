<?php
namespace AD\AdBundle\Form;

use AD\AdBundle\Entity\PrdInventr;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PrdInventrType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder->add('id', HiddenType::class)
				->add('nom', HiddenType::class)
				->add('categorie', HiddenType::class)
				->add('stockreel', HiddenType::class)
				->add('stockinventaire', TextType::class, array('label'=>false, 'attr'=> array('placeholder'=>'0', 'class'=>'form-control', 'style'=>'width:100px; cursor:pointer')))
            	;
	}
    public function getName()
      {
          return 'ad_adbundle_prdinventr'; 
      }

    public function configureOptions(OptionsResolver $resolver)
    {  
    	$resolver->setDefaults(array( 'data_class' => PrdInventr::class, ) );
	}

}