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
        $categorie1->setNom('Légumes'); 
        $categorie1->setImage($this->getReference('media2'));
        $manager->persist($categorie1);

        $categorie2 = new Categories(); //Font suite les setters des champs à définir
        $categorie2->setNom('Fruits'); 
        $categorie2->setImage($this->getReference('media3'));
        $manager->persist($categorie2);

        $manager->flush();

        $this->addReference('categorie1', $categorie1);
        $this->addReference('categorie2', $categorie2); 
    }

     public function getOrder()
    {    return 2;    }

}
?>