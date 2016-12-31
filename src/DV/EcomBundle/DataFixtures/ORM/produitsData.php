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
        $produits1->setCategories($this->getReference('categorie1')); 
        $produits1->setDescription('Ceci est un légumes délicieux'); 
        $produits1->setDisponible('1');
        $produits1->setImage($this->getReference('media1'));
        $produits1->setNom('tomate');    
        $produits1->setPrix('1.99');   
        $produits1->setTva($this->getReference('tva2'));    
        $manager->persist($produits1);

        $produits2 = new Produits(); //Font suite les setters des champs à définir
        $produits2->setCategories($this->getReference('categorie1')); 
        $produits2->setDescription('Ceci est un légumes vraiment délicieux'); 
        $produits2->setDisponible('1');
        $produits2->setImage($this->getReference('media2'));
        $produits2->setNom('tomate2');    
        $produits2->setPrix('1.92');   
        $produits2->setTva($this->getReference('tva2'));    
        $manager->persist($produits2);

        $produits3 = new Produits(); //Font suite les setters des champs à définir
        $produits3->setCategories($this->getReference('categorie2')); 
        $produits3->setDescription('Ceci est un fruit délicieux'); 
        $produits3->setDisponible('1');
        $produits3->setImage($this->getReference('media3'));
        $produits3->setNom('framboise');    
        $produits3->setPrix('0.10');   
        $produits3->setTva($this->getReference('tva2'));    
        $manager->persist($produits3);

        $manager->flush();

        //$this->addReference('produits1', $produits1);
        //$this->addReference('produits2', $produits2);
        //$this->addReference('produits3', $produits3);
    }

     public function getOrder()
    {    return 4;    }

}
?>