<?php

namespace AD\AdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PromoProdsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('label'=>'Nom de la promo', 'label_attr'=>array('class'=>'col-xs-2'), 'attr'=>array('class'=>'col-xs-3')))

            ->add('produit',EntityType::class,array( 'label'=>'Produit concerné', 'label_attr'=>array('class'=>'col-xs-2') ,'class'=> 'DV\EcomBundle\Entity\Produits', 'attr'=>array('class'=>'col-xs-3'), 
                'query_builder' => function (\DV\EcomBundle\Repository\ProduitsRepository $rep) {
                        return $rep->createQueryBuilder('pp')->orderBy('pp.nom', 'ASC'); },       
                     'expanded' => false, 'multiple' => false, 'empty_value'=>'-Choisissez-' ))  
            ->add('datedeb', DateType::class, array('label'=>'Date de démarrage', 'label_attr'=>array('class'=>'col-xs-2'),  'widget' => 'choice','input' => 'datetime', 'years' => array('2016','default'=>'2017', '2018', '2019', '2020','2021')))  
            ->add('datefin', DateType::class, array('label'=>'Date fin', 'label_attr'=>array('class'=>'col-xs-2'),  'widget' => 'choice', 'years' => array('default'=>'2017', '2018', '2019', '2020','2021')))
            ->add('remisePourcent', NumberType::class, array('label'=>'Remise %', 'label_attr'=>array('class'=>'col-xs-2'), 'attr'=>array('class'=>'col-xs-1'), 'required'=>false))
            ->add('remiseEuro', NumberType::class, array('label'=>'Rabais €', 'label_attr'=>array('class'=>'col-xs-2'), 'attr'=>array('class'=>'col-xs-1'), 'required'=>false))
            ->add('apartirdeqte', IntegerType::class, array('label'=>'A partir de qté', 'label_attr'=>array('class'=>'col-xs-2'), 'attr'=>array('class'=>'col-xs-1')))
            ->add('codepromo', TextType::class, array('label'=>'Code promo', 'label_attr'=>array('class'=>'col-xs-2'), 'attr'=>array('class'=>'col-xs-3'), 'required'=>false))
            ->add('affichePub', ChoiceType::class, array('label'=>'Affichage pub', 'label_attr'=>array('class'=>'col-xs-2'), 'attr'=>array('class'=>'col-xs-3'), 'choices'=>array('0'=>'non', '1'=>'oui'), 'expanded'=>true, 'multiple'=>false))
            ->add('articlePub', TextareaType::class, array('label'=>'Article pub', 'label_attr'=>array('class'=>'col-xs-2'), 'attr'=>array('class'=>'col-xs-3', 'row'=>'3'), 'required'=>false))
            ->add('imagePub', TextType::class, array('label'=>'Url image pub', 'label_attr'=>array('class'=>'col-xs-2'), 'attr'=>array('class'=>'col-xs-3'), 'required'=>false))
            ->add('bandeauPub', TextType::class, array('label'=>'Url image bandeau pub', 'label_attr'=>array('class'=>'col-xs-2'), 'attr'=>array('class'=>'col-xs-3'), 'required'=>false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DV\EcomBundle\Entity\PromoProds'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ad_adbundle_promoprods';
    }
}
