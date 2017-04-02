<?php

namespace AD\AdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FournisseursType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array( 'label'=>'Nom de la société','label_attr'=>array('class' =>'col-xs-2'), 'attr'=>array('class' =>'col-xs-4 form-control' ,'style'=>"max-width:400px")))
            ->add('adresse', TextType::class, array('required' => false, 'label_attr'=>array('class' =>'col-xs-2 '), 'attr'=>array('class' =>'col-xs-4 form-control' ,'style'=>"max-width:400px")))
            ->add('cp', TextType::class, array('required' => false, 'label_attr'=>array('class' =>'col-xs-2'), 'attr'=>array('class' =>'col-xs-4 form-control' ,'style'=>"max-width:400px")))
            ->add('ville', TextType::class, array('required' => false, 'label_attr'=>array('class' =>'col-xs-2'), 'attr'=>array('class' =>'col-xs-4 form-control' ,'style'=>"max-width:400px")))
            ->add('pays', TextType::class, array('empty_data' => 'France', 'required' => false, 'label_attr'=>array('class' =>'col-xs-2'), 'attr'=>array('class' =>'col-xs-4 form-control' ,'style'=>"max-width:400px")))            
            ->add('telephone', TextType::class, array('required' => false, 'label_attr'=>array('class' =>'col-xs-2'), 'attr'=>array('class' =>'col-xs-4 form-control' ,'style'=>"max-width:400px")))
            ->add('fax', TextType::class, array('required' => false, 'label_attr'=>array('class' =>'col-xs-2'), 'attr'=>array('class' =>'col-xs-4 form-control' ,'style'=>"max-width:400px")))
            ->add('email', TextType::class, array('required' => false, 'label_attr'=>array('class' =>'col-xs-2'), 'attr'=>array('class' =>'col-xs-4 form-control' ,'style'=>"max-width:400px")))
            ->add('commercial', TextType::class, array('required' => false, 'label'=>'Nom du commercial', 'label_attr'=>array('class' =>'col-xs-2'), 'attr'=>array('class' =>'col-xs-4 form-control' ,'style'=>"max-width:400px")))
            ->add('tel_commerc', TextType::class, array('required' => false, 'label'=>'Tel du commercial','label_attr'=>array('class' =>'col-xs-2'), 'attr'=>array('class' =>'col-xs-4 form-control' ,'style'=>"max-width:400px")))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AD\AdBundle\Entity\Fournisseurs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ad_adbundle_fournisseurs';
    }
}
