<?php

namespace AD\AdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MediaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, array('label' => 'Fichier à télécharger :', 'label_attr'=>array('class'=>'col-xs-3'),'required' => false, 'attr'=>array('class'=>'col-xs-8')))
            ->add('name', TextType::class, array('label' => 'Nom de l\'image', 'label_attr'=>array('class'=>'col-xs-3'), 'required' => false, 'attr'=>array('class'=>'col-xs-4')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DV\EcomBundle\Entity\Media'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ad_adbundle_media';
    }
}
