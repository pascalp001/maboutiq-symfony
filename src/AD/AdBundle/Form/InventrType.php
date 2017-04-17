<?php
namespace AD\AdBundle\Form;

use AD\AdBundle\Entity\Inventr;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class InventrType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder->add('prdInventr', CollectionType::class, array('entry_type' => PrdInventrType ::class))
				->add('submit', SubmitType::class, array('label'=>'Validation provisoire partielle de l\'inventaire', 'attr'=> array('class'=>'form-control btn btn-info', 'style'=>'color:#132; line-height: 40px; font-size: 20px; width: 400px; min-height:50px;')))      
        ->add('validprov', HiddenType::class, array('attr'=> array('value'=>'0')))	
        ;
	}
  public function getBlockPrefix()
    {
        return 'ad_adbundle_inventr'; 
    }
  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array('data_class' => Inventr::class,));
  }
}
?>