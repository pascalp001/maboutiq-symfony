<?php

namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
//use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('pays', TextType::class, array('empty_data' => 'France')) 
            ->add('fact', CheckboxType::class, array('label' => 'facturation', 'required' => false, 'value' => true))  
            ->add('livr', CheckboxType::class, array('label' => 'livraison', 'required' => false, 'value' => true))  
            //->add('utilisateur')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    // public function configureOptions(OptionsResolver $resolver)
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DV\EcomBundle\Entity\UtilisateursAdresses'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'dv_ecombundle_utilisateursadresses';
    }
}
