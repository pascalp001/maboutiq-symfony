<?php
namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
            ->add('titre', TextType::class, array('label'=>'Titre / objet :','label_attr' => array('class' => 'col-xs-offset-1 col-xs-3'), 'attr' => array('class' => 'col-xs-8')))
            ->add('content',TextareaType::class, array('label'=>'Votre message :','label_attr' => array('class' => 'col-xs-offset-1 col-xs-3'),'attr' => array('class' => 'col-xs-8')))
            ->add('email',TextType::class, array('label'=>'Votre email (facultatif) :','label_attr' => array('class' => 'col-xs-offset-1 col-xs-3'),'attr' => array('class' => 'col-xs-8'), 'required' => false))
            ->add('tel',TextType::class, array('label'=>'Votre numero de téléphone (facultatif) :','label_attr' => array('class' => 'col-xs-offset-1 col-xs-3'),'attr' => array('class' => 'col-xs-8'), 'required' => false))
            ;

	}
    public function getBlockPrefix()
      {
          return 'ecom_ecombundle_message'; 
      }

}
?>