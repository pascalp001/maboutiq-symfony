<?php
namespace DV\EcomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DV\EcomBundle\Entity\Tva;

class TvaData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tva1 = new Tva(); //Font suite les setters des champs à définir
        $tva1->setMultiplicate('0.982'); 
        $tva1->setNom('TVA 1.75%'); 
        $tva1->setValeur('1.75');
        $manager->persist($tva1);

        $tva2 = new Tva(); //Font suite les setters des champs à définir
        $tva2->setMultiplicate('0.833'); 
        $tva2->setNom('TVA 20%'); 
        $tva2->setValeur('20');
        $manager->persist($tva2);

        $manager->flush();

        $this->addReference('tva1', $tva1);
        $this->addReference('tva2', $tva2);
    }

     public function getOrder()
    {    return 3;    }

}
?>