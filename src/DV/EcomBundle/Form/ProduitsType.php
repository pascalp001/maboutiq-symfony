<?php

namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DV\EcomBundle\Form\MediaType;

class ProduitsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text')
            ->add('categorie')
            ->add('image', new MediaType())
            ->add('descripcourt', 'textarea')
            ->add('description', 'textarea')
            ->add('donneestech', 'textarea')
            ->add('prix', 'text')
            ->add('poids', 'number', array('empty_data' => '0'))
            ->add('taille')
            ->add('largeur')
            ->add('epaiss')
            ->add('disponible', 'number', array('empty_data' => '1'))
            ->add('stockreel', 'number', array('empty_data' => '1'))            
            ->add('tva')
            ->add('popularite', 'number',array('empty_data' => '1'))
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DV\EcomBundle\Entity\Produits'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dv_ecombundle_produits';
    }
}
