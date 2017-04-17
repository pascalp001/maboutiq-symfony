<?php

namespace AD\AdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AD\AdBundle\Form\MediaType;

class CategoriesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('label'=>'Nom de la catégorie', 'label_attr'=>array('class'=>'col-xs-3'), 'attr'=>array('class'=>'col-xs-3')))
            ->add('image',  MediaType::class, array( 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;'))) 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DV\EcomBundle\Entity\Categories'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'ad_adbundle_categories';
    }
}
