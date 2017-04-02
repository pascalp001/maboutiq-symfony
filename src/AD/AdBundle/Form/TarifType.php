<?php

namespace AD\AdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TarifType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('label' => 'Nom tarif'))
            ->add('org', TextType::class, array('label' => 'Organisme'))
            ->add('img', TextType::class, array('label' => 'Url image'))
            ->add('typPays', TextType::class, array('label' => 'Classe pays'))
            ->add('annee', TextType::class, array('label' => 'Année'))
            ->add('maxdim', TextType::class, array('label' => 'Dimension maxi'))
            ->add('maxepais', TextType::class, array('label' => 'Epaisseur maxi'))
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
        return 'ad_adbundle_tarif';
    }
}
