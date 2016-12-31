<?php
// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace DV\EcomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DV\EcomBundle\Entity\Commandes;

class CommandesData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $commande1 = new Commandes(); //Font suite les setters des champs à définir
        $commande1->setUtilisateur($this->getReference('utilisateurs1')); 
        $commande1->setValider('1');
        $commande1->setDate(new \DateTime);
        $commande1->setReference('1');
        $commande1->setProduits(array('0'=> array('1'=>'2'),
                                    '1'=> array('2'=>'1'),
                                    '2'=> array('3'=>'1')));
        $manager->persist($commande1);

        $commande2 = new Commandes(); //Font suite les setters des champs à définir
        $commande2->setUtilisateur($this->getReference('utilisateurs2')); 
        $commande2->setValider('1');
        $commande2->setDate(new \DateTime);
        $commande2->setReference('2');
        $commande2->setProduits(array('0'=> array('2'=>'8')));
        $manager->persist($commande1);

        $manager->flush();

    }

     public function getOrder()
    {    return 7;    }

}
?>