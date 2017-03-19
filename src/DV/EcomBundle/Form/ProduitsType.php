<?php

namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DV\EcomBundle\Form\MediaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

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
            ->add('nom', TextType::class, array( 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))
            ->add('categorie',EntityType::class,array( 'label'=>'Catégorie' ,'class'=> 'DV\EcomBundle\Entity\Categories', 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;'), 
                 'query_builder' => function (\DV\EcomBundle\Repository\CategoriesRepository $rep) {
                        return $rep->createQueryBuilder('ac')->orderBy('ac.nom', 'DESC'); },       
                     'expanded' => false, 'multiple' => false, 'empty_value'=>'-Choisissez-' ))
            //->add('image', 'collection', array('type'=> new MediaType(), 'allow_add'=>false, 'allow_delete'=>true))
            ->add('image',  new MediaType(), array( 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))
            ->add('descripcourt', TextareaType::class, array( 'label'=>'Description sommaire' ,'attr'=>array('rows'=>'1','style' =>'margin-top:5px; margin-bottom: 3px;')))
            ->add('description', TextareaType::class, array( 'label'=>'Descriptions détaillées' ,'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))
            ->add('donneestech', TextareaType::class, array('label'=>'Données techniques' ,'required' => false, 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))
            ->add('prix', TextType::class,array('label'=>'Prix HT' ,'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))
            ->add('poids', NumberType::class, array('empty_data' => '0', 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))
            ->add('taille', null, array('required' => false, 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))
            ->add('largeur', null, array('required' => false, 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))
            ->add('epaiss', null, array('label'=>'Epaisseur' ,'required' => false, 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))
            ->add('disponible', TextType::class, array('empty_data' => '1', 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))
            ->add('stockreel', NumberType::class, array('label'=>'Stock réel' ,'empty_data' => '1', 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))            
            ->add('tva',EntityType::class, array( 'label'=>'Taux de TVA' ,'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px; '),
                'class'=> 'DV\EcomBundle\Entity\Tva', 
                'query_builder' => function (\DV\EcomBundle\Repository\TvaRepository $rep) {
                        return $rep->createQueryBuilder('pt')->orderBy('pt.nom', 'DESC'); },
                'expanded' => true, 
                'multiple' => false
                ))
            ->add('popularite', NumberType::class,array('label'=>'popularité' ,'empty_data' => '1', 'attr'=>array('style' =>'margin-top:5px; margin-bottom: 3px;')))
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
