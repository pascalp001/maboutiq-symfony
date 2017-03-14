<?php

namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TarifType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array('label' => 'Nom tarif'))
            ->add('org', 'text', array('label' => 'Organisme'))
            ->add('img', 'text', array('label' => 'Url image'))
            ->add('typPays', 'text', array('label' => 'Classe pays'))
            ->add('annee', 'text', array('label' => 'Année'))
            ->add('maxdim', 'text', array('label' => 'Dimension maxi'))
            ->add('maxepais', 'text', array('label' => 'Epaisseur maxi'))
            ->add('t0')
            ->add('p0')
            ->add('t1')
            ->add('p1')
            ->add('t2')
            ->add('p2')
            ->add('t3')
            ->add('p3')
            ->add('t4')
            ->add('p4')
            ->add('t5')
            ->add('p5')
            ->add('t6')
            ->add('p6')
            ->add('t7')
            ->add('p7')
            ->add('t8')
            ->add('p8')
            ->add('t9')
            ->add('p9')
            ->add('t10')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DV\EcomBundle\Entity\Tarif'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dv_ecombundle_tarif';
    }
}
