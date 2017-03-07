<?php
namespace DV\EcomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class LivraisonType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
            ->add('nom', HiddenType::class, array('attr' => array('class' => 'cb_Nom')))
            ->add('prenom',HiddenType::class, array('attr' => array('class' => 'cb_Prenom', 'required' => false)))
            ->add('adresse',HiddenType::class, array('attr' => array('class' => 'cb_Adresse')))
            ->add('complement',HiddenType::class, array('attr' => array('class' => 'cb_Complt', 'required' => false)))
            ->add('cp',HiddenType::class, array('attr' => array('class' => 'cb_CP')))
            ->add('ville',HiddenType::class, array('attr' => array('class' => 'cb_Ville')) )
            
            //->add('org', HiddenType::class, array())  
            ;

	}
    public function getName()
      {
          return 'ecom_ecombundle_livraison'; // Syntaxe particulière : minuscules et underscores
      }

}
?>