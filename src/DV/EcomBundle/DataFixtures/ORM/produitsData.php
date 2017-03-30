<?php
namespace DV\EcomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DV\EcomBundle\Entity\Produits;

class ProduitsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $produits1 = new Produits(); //Font suite les setters des champs à définir
        $produits1->setCategorie($this->getReference('categorie4')); 
        $produits1->setDescription('Ceci est un coquillage extraordinaire'); 
        $produits1->setDescripcourt('Ceci est un coquillage');
        $produits1->setDisponible('1');
        $produits1->setImage($this->getReference('media1'));
        $produits1->setNom('coquillage');    
        $produits1->setPrix('15.42');   
        $produits1->setPoids('50'); 
        $produits1->setTaille('51.5'); 
        $produits1->setLargeur('44'); 
        $produits1->setEpaiss('41'); 
        $produits1->setPopularite('1'); 
        $produits1->setDisponible('1'); 
        $produits1->setStockreel('5'); 
        $produits1->setStockvirtuel('5'); 
        $produits1->setTva($this->getReference('tva2'));    
        $manager->persist($produits1);

        $produits2 = new Produits(); //Font suite les setters des champs à définir
        $produits2->setCategorie($this->getReference('categorie1')); 
        $produits2->setDescription('Ceci est un joli murex'); 
        $produits2->setDescripcourt('Ceci est un joli murex qu\'on peut trouver enfoncé sous la plante des pieds' );
        $produits2->setDisponible('1');
        $produits2->setImage($this->getReference('media3'));
        $produits2->setNom('Murex troscheli');    
        $produits2->setPrix('15.42');   
        $produits2->setPoids('70'); 
        $produits2->setTaille('80'); 
        $produits2->setLargeur('40'); 
        $produits2->setEpaiss('40'); 
        $produits2->setPopularite('1'); 
        $produits2->setDisponible('1'); 
        $produits2->setStockreel('8'); 
        $produits2->setStockvirtuel('8');  
        $produits2->setTva($this->getReference('tva2'));    
        $manager->persist($produits2);

        $produits3 = new Produits(); //Font suite les setters des champs à définir
        $produits3->setCategorie($this->getReference('categorie2')); 
        $produits3->setDescription('Ceci est une jolie porcelaine'); 
        $produits3->setDescripcourt('Ceci est une jolie porcelaine qu\'on peut pêcher dans les mares aux canards' );
        $produits3->setDisponible('1');
        $produits3->setImage($this->getReference('media4'));  
        $produits3->setNom('Cypraea pantherina');  
        $produits3->setPrix('10');   
        $produits3->setPoids('20'); 
        $produits3->setTaille('30'); 
        $produits3->setLargeur('22'); 
        $produits3->setEpaiss('17'); 
        $produits3->setPopularite('1'); 
        $produits3->setDisponible('1'); 
        $produits3->setStockreel('3'); 
        $produits3->setStockvirtuel('3'); 
        $produits3->setTva($this->getReference('tva2'));    
        $manager->persist($produits3);

        $manager->flush();


        $produits4 = new Produits(); //Font suite les setters des champs à définir
        $produits4->setCategorie($this->getReference('categorie6')); 
        $produits4->setDescription('Ceci est un très joli boulon'); 
        $produits4->setDescripcourt('Vous serez surpris par l\'eclat et les formes extraordinaires de ce boulon' );
        $produits4->setDisponible('1');
        $produits4->setImage($this->getReference('media7'));  
        $produits4->setNom('Boulon gris-métalisé');  
        $produits4->setPrix('1');   
        $produits4->setPoids('10'); 
        $produits4->setTaille('20'); 
        $produits4->setLargeur('20'); 
        $produits4->setEpaiss('8'); 
        $produits4->setPopularite('1'); 
        $produits4->setDisponible('1'); 
        $produits4->setStockreel('28'); 
        $produits4->setStockvirtuel('28'); 
        $produits4->setTva($this->getReference('tva2'));    
        $manager->persist($produits4);

        $manager->flush();
        //$this->addReference('produits1', $produits1);
        //$this->addReference('produits2', $produits2);
        //$this->addReference('produits3', $produits3);
    }

     public function getOrder()
    {    return 4;    }

}
?>