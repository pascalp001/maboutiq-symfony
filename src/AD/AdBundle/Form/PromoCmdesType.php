<?php

namespace AD\AdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PromoCmdesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('datedeb')
            ->add('datefin')
            ->add('remisePourcent')
            ->add('remiseEuro')
            ->add('frlivrgratuit')
            ->add('apartirdemontant')
            ->add('codepromo')
            ->add('affichePub')
            ->add('articlePub')
            ->add('imagePub')
            ->add('comande')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DV\EcomBundle\Entity\PromoCmdes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ad_adbundle_promocmdes';
    }
}
