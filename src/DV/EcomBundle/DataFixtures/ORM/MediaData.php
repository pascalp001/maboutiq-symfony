<?php
// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace DV\EcomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DV\EcomBundle\Entity\Media;

class MediaData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $media1 = new Media(); //Font suite les setters des champs à définir
        $media1->setName('Tchatcheria Mirabilis'); 
        $media1->setPath('931f89ce629f0f5f414200fec5715df6a83777a9.png');
        $manager->persist($media1);

        $media2 = new Media(); 
        $media2->setName('Latiaxis mawae'); 
        $media2->setPath('0eee83dbaf172bf3a2f351f724e2176c240395dc.jpeg');
        $manager->persist($media2);

        $media3 = new Media(); 
        $media3->setName('Murex'); 
        $media3->setPath('230px-Murex_troscheli_147a.jpeg');
        $manager->persist($media3);

        $media4 = new Media(); 
        $media4->setName('Porcelaine'); 
        $media4->setPath('Cypraea_pantherina_1a.jpeg');
        $manager->persist($media4);

        $media5 = new Media();
        $media5->setName('Gasteropodes divers'); 
        $media5->setPath('192342.jpeg');
        $manager->persist($media5);

        $media6 = new Media(); 
        $media6->setName('Bivalves divers'); 
        $media6->setPath('symmetry.jpeg');
        $manager->persist($media6);
        $manager->flush();

        $media7 = new Media();
        $media7->setName('Boulon'); 
        $media7->setPath('boulon2.jpg');
        $manager->persist($media7);
        $manager->flush();

        $this->addReference('media1', $media1);
        $this->addReference('media2', $media2);
        $this->addReference('media3', $media3);
        $this->addReference('media4', $media4);
        $this->addReference('media5', $media5);
        $this->addReference('media6', $media6);  
        $this->addReference('media7', $media7);     
    }

     public function getOrder()
    {    return 1;    }

}
?>