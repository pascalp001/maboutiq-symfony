<?php

namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UtilisateursAdressesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom', null, array('required' => false))
            ->add('telephone')
            ->add('adresse')
            ->add('complement', null, array('required' => false))
            ->add('cp')
            ->add('ville')
            ->add('pays', 'text', array('empty_data' => 'France'))           
            //->add('utilisateur')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DV\EcomBundle\Entity\UtilisateursAdresses'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dv_ecombundle_utilisateursadresses';
    }
}
