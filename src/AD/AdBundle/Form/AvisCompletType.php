<?php
namespace AD\AdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AvisCompletType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder->add('stars', NumberType::class, array('label'=>'note /5', 'attr'=> array('class'=>'col-xs-2')))
				->add('titre', TextType::class, array('label'=>'Titre de l\'avis', 'attr'=> array('class'=>'form-control', 'style'=>'color:#132; line-height: 20px; font-size: 15px;')))
				->add('comment', TextareaType::class, array('label'=>'Le commentaire', 'attr'=> array('class'=>'form-control ', 'placeholder'=>'Votre avis...', 'style'=>'color:#132; line-height: 20px; font-size: 15px;')))	
				->add('valid', NumberType::class, array('label'=>'Valider l\'avis', 'attr'=> array('class'=>'col-xs-2'))	)
            	->getForm();
            	;
	}
    public function getBlockPrefix()
      {
          return 'ad_adbundle_aviscomplet'; // Syntaxe particulière : minuscules et underscores
      }

}
?>