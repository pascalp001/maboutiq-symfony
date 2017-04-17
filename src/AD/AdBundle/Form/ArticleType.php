<?php

namespace AD\AdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array( 'label'=>'Titre de l\'article','label_attr'=>array('class' =>'col-xs-2'), 'required' => false, 'attr'=>array('class' =>'col-xs-2 form-control' ,'style'=>"max-width:400px")))
            ->add('comment', TextareaType::class, array( 'label'=>'Rédaction ','label_attr'=>array('class' =>'col-xs-2'), 'attr'=>array('class' =>'col-xs-2 form-control' ,'style'=>"max-width:400px")))
            ->add('datedeb', DateType::class, array('label'=>'Date de publication', 'label_attr'=>array('class'=>'col-xs-2'),  'widget' => 'choice','input' => 'datetime', 'years' => array('2016','default'=>'2017', '2018', '2019', '2020','2021')))
            ->add('datefin', DateType::class, array('label'=>'Date fin', 'label_attr'=>array('class'=>'col-xs-2'), 'required' => false,  'widget' => 'choice', 'years' => array('default'=>'2017', '2018', '2019', '2020','2021')))
            ->add('prop1', TextType::class, array( 'label'=>'Image jointe','label_attr'=>array('class' =>'col-xs-2'), 'required' => false, 'attr'=>array('class' =>'col-xs-2 form-control' ,'style'=>"max-width:400px")))
            ->add('prop2', TextType::class, array( 'label'=>'Autre','label_attr'=>array('class' =>'col-xs-2'),'required' => false,  'attr'=>array('class' =>'col-xs-2 form-control' ,'style'=>"max-width:400px")))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DV\EcomBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'dv_ecombundle_article';
    }
}
