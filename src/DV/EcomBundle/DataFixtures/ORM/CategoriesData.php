<?php
// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace DV\EcomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DV\EcomBundle\Entity\Categories;

class CategoriesData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categories(); //Font suite les setters des champs à définir
        $categorie1->setNom('Coquillage'); 
        $categorie1->setImage($this->getReference('media2'));
        $manager->persist($categorie1);

        $categorie2 = new Categories(); //Font suite les setters des champs à définir
        $categorie2->setNom('Murex'); 
        $categorie2->setImage($this->getReference('media3'));
        $manager->persist($categorie2);

        $categorie3 = new Categories(); //Font suite les setters des champs à définir
        $categorie3->setNom('Porcelaines'); 
        $categorie3->setImage($this->getReference('media4'));
        $manager->persist($categorie3);

        $categorie4 = new Categories(); //Font suite les setters des champs à définir
        $categorie4->setNom('DivGasterop'); 
        $categorie4->setImage($this->getReference('media5'));
        $manager->persist($categorie4);

        $categorie5 = new Categories(); //Font suite les setters des champs à définir
        $categorie5->setNom('DivBivalve'); 
        $categorie5->setImage($this->getReference('media6'));
        $manager->persist($categorie5);
        $manager->flush();

        $this->addReference('categorie1', $categorie1);
        $this->addReference('categorie2', $categorie2); 
        $this->addReference('categorie3', $categorie3); 
        $this->addReference('categorie4', $categorie4);
        $this->addReference('categorie5', $categorie5);
    }

     public function getOrder()
    {    return 2;    }

}
?>