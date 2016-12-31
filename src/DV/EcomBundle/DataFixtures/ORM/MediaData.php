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
        $media1->setAlt('ceci est un test'); 
        $media1->setPath('http://www.olivelineblog.com/wp-content/uploads/2015/09/tomate21.jpg');
        $manager->persist($media1);

        $media2 = new Media(); //Font suite les setters des champs à définir
        $media2->setAlt('Legumes'); 
        $media2->setPath('http://www.olivelineblog.com/wp-content/uploads/2015/09/tomate21.jpg');
        $manager->persist($media2);

        $media3 = new Media(); //Font suite les setters des champs à définir
        $media3->setAlt('Legumes'); 
        $media3->setPath('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWZQ_RCJjuo7liPXeM8hO92gBVEIb2bBKj0-v7vQ-AZkL3wMQI6Q');
        $manager->persist($media3);

        $manager->flush();

        $this->addReference('media1', $media1);
        $this->addReference('media2', $media2);
        $this->addReference('media3', $media3);
    }

     public function getOrder()
    {    return 1;    }

}
?>