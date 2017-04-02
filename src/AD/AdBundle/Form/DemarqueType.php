<?php
namespace AD\AdBundle\Form;

use AD\AdBundle\Entity\Demarque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class DemarqueType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder->add('prdDemarque', CollectionType::class, array('entry_type' => PrdDemarqueType ::class))
				->add('submit', SubmitType::class, array('label'=>'Valider', 'attr'=> array('class'=>'form-control btn btn-info', 'style'=>'color:#132; line-height: 25px; font-size: 20px; width: 250px; min-height:40px;')))	;
	}
    public function getName()
      {
          return 'ad_adbundle_demarque'; 
      }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Demarque::class,));
    }
}
?>