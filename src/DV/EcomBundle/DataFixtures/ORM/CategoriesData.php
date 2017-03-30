<?php
// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace DV\EcomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DV\EcomBundle\Entity\Tarif;

class TarifData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tarif1 = new Tarif(); //Font suite les setters des champs à définir
        $tarif1->setNom('DivGastropod'); 
        $tarif3->setImage($this->getReference('media1'));
        $manager->persist($tarif1);

        $tarif2 = new Tarif(); //Font suite les setters des champs à définir
        $tarif2->setNom('Murex'); 
        $tarif2->setImage($this->getReference('media3'));
        $manager->persist($tarif2);

        $tarif3 = new Tarif(); //Font suite les setters des champs à définir
        $tarif3->setNom('Porcelaines'); 
        $tarif3->setImage($this->getReference('media4'));
        $manager->persist($tarif3);

        $tarif4 = new Tarif(); //Font suite les setters des champs à définir
        $tarif4->setNom('DivGasterop'); 
        $tarif4->setImage($this->getReference('media1'));
        $manager->persist($tarif4);

        $tarif5 = new Tarif(); //Font suite les setters des champs à définir
        $tarif5->setNom('DivBivalve'); 
        $tarif5->setImage($this->getReference('media6'));
        $manager->persist($tarif5);
        $manager->flush();

        $tarif6 = new tarif(); //Font suite les setters des champs à définir
        $tarif6->setNom('Boulons'); 
        $tarif6->setImage($this->getReference('media7'));
        $manager->persist($tarif6);
        $manager->flush();


    }

     public function getOrder()
    {    return 2;    }

}
?>