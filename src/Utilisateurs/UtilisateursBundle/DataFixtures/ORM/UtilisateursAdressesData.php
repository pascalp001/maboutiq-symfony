<?php
namespace Utilisateurs\UtilisateursBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DV\EcomBundle\Entity\UtilisateursAdresses;

class UtilisateursAdressesData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $adresse1 = new UtilisateursAdresses(); //Font suite les setters des champs à définir
        $adresse1->setUtilisateur($this->getReference('utilisateurs1')); 
        $adresse1->setNom('Geronimo');
        $adresse1->setPrenom('Gege');
        $adresse1->setTelephone('0102030405');
        $adresse1->setAdresse('ru de la rue');
        $adresse1->setCp('76600');
        $adresse1->setVille('Le Havre');
        $adresse1->setPays('France');
        $manager->persist($adresse1);

        $adresse2 = new UtilisateursAdresses(); //Font suite les setters des champs à définir
        $adresse2->setUtilisateur($this->getReference('utilisateurs2')); 
        $adresse2->setNom('pascalp');
        $adresse2->setPrenom('pascal');
        $adresse2->setTelephone('06060606');
        $adresse2->setAdresse('35 rue de Gravelines');
        $adresse2->setCp('86100');
        $adresse2->setVille('Châtellerault');
        $adresse2->setPays('France');
        $manager->persist($adresse2);



        $manager->flush();

        //$this->addReference('adresse1', $adresse1);
        //$this->addReference('adresse2', $adresse2);
    }

     public function getOrder()
    {    return 6;    }

}
?>