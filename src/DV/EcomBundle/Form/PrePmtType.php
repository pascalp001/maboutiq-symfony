<?php
namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PrePmtType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder->add('modbq', 'hidden', array('label'=>false, 'attr'=> array('class'=>'modbq', 'value'=>'1')));
	}
    public function getName()
      {
          return 'ecom_ecombundle_prepmt'; 
      }

}
?>