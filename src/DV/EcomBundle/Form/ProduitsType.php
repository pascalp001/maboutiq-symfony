<?php

namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DV\EcomBundle\Form\MediaType;
use Symfony\Component\HttpFoundation\Request;

class ProduitsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tvaFixe='TVA 20%';
        $builder
            ->add('nom', 'text')
            ->add('categorie','entity',array( 'class'=> 'DV\EcomBundle\Entity\Categories',  
                 'query_builder' => function (\DV\EcomBundle\Repository\CategoriesRepository $rep) {
                        return $rep->createQueryBuilder('ac')->orderBy('ac.nom', 'DESC'); },       
                     'expanded' => false, 'multiple' => false, 'empty_value'=>'-Choisissez-' ))
            //->add('image', 'collection', array('type'=> new MediaType(), 'allow_add'=>false, 'allow_delete'=>true))
            ->add('image',  new MediaType())
            ->add('descripcourt', 'textarea')
            ->add('description', 'textarea')
            ->add('donneestech', 'textarea', array('required' => false))
            ->add('prix', 'text',array('label'=>'Prix HT' ))
            ->add('poids', 'number', array('empty_data' => '0'))
            ->add('taille', null, array('required' => false))
            ->add('largeur', null, array('required' => false))
            ->add('epaiss', null, array('required' => false))
            ->add('disponible', 'text', array('empty_data' => '1'))
            ->add('stockreel', 'number', array('empty_data' => '1'))            
            ->add('tva','entity', array( 
                'class'=> 'DV\EcomBundle\Entity\Tva',  
                'query_builder' => function (\DV\EcomBundle\Repository\TvaRepository $rep) {
                        return $rep->createQueryBuilder('pt')->orderBy('pt.nom', 'DESC'); },
                'expanded' => true, 
                'multiple' => false
                ))
            ->add('popularite', 'number',array('empty_data' => '1'))
            ->get('tva')->setData('TVA 20%')
            
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
