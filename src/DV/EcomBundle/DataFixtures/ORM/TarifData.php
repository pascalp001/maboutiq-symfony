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
        $tarif1->setNom('petit paquet'); 
        $tarif1->setOrg('La Poste');
        $tarif1->setImg('img/LettreSuivie.jpg');
        $tarif1->setTypPays('1'); 
        $tarif1->setAnnee('2017'); 
        $tarif1->setMaxdim('100'); 
        $tarif1->setMaxepais('30'); 
        $tarif1->setT0('0.73'); 
        $tarif1->setP0('20');
        $tarif1->setT1('1.46'); 
        $tarif1->setP1('100'); 
        $tarif1->setT2('2.92'); 
        $tarif1->setP2('250'); 
        $tarif1->setT3('4.38'); 
        $tarif1->setP3('500'); 
        $tarif1->setT4('5.84'); 
        $tarif1->setP4('3000'); 
        $tarif1->setT5('88888.88'); 
        $tarif1->setP5('88888888'); 
        $tarif1->setT6('88888.88'); 
        $tarif1->setP6('88888888'); 
        $tarif1->setT7('88888.88'); 
        $tarif1->setP7('88888888'); 
        $tarif1->setT8('88888.88'); 
        $tarif1->setP8('88888888'); 
        $tarif1->setT9('88888.88'); 
        $tarif1->setP9('88888888'); 
        $tarif1->setT10('88888.88'); 
        $manager->persist($tarif1);

        $tarif2 = new Tarif(); //Font suite les setters des champs à définir
        $tarif1->setNom('colissimo'); 
        $tarif1->setOrg('La Poste');
        $tarif1->setImg('img/colissimo2.png');
        $tarif1->setTypPays('1'); 
        $tarif1->setAnnee('2017'); 
        $tarif1->setMaxdim('888888'); 
        $tarif1->setMaxepais('8888'); 
        $tarif1->setT0('4.90'); 
        $tarif1->setP0('250');
        $tarif1->setT1('6.10'); 
        $tarif1->setP1('500'); 
        $tarif1->setT2('6.90'); 
        $tarif1->setP2('750'); 
        $tarif1->setT3('7.50'); 
        $tarif1->setP3('1000'); 
        $tarif1->setT4('8.50'); 
        $tarif1->setP4('2000'); 
        $tarif1->setT5('12.90'); 
        $tarif1->setP5('5000'); 
        $tarif1->setT6('18.9'); 
        $tarif1->setP6('10000'); 
        $tarif1->setT7('26.90'); 
        $tarif1->setP7('30000'); 
        $tarif1->setT8('88888.88'); 
        $tarif1->setP8('88888888'); 
        $tarif1->setT9('88888.88'); 
        $tarif1->setP9('88888888'); 
        $tarif1->setT10('88888.88'); 
        $manager->persist($tarif2);

        $tarif3 = new Tarif(); //Font suite les setters des champs à définir
        $tarif1->setNom('petit paquet'); 
        $tarif1->setOrg('Mondial Relay');
        $tarif1->setImg('img/mRelay.png');
        $tarif1->setTypPays('1'); 
        $tarif1->setAnnee('2017'); 
        $tarif1->setMaxdim('150'); 
        $tarif1->setMaxepais('10'); 
        $tarif1->setT0('4.55'); 
        $tarif1->setP0('500');
        $tarif1->setT1('5.25'); 
        $tarif1->setP1('1000'); 
        $tarif1->setT2('5.95'); 
        $tarif1->setP2('2000'); 
        $tarif1->setT3('6.80'); 
        $tarif1->setP3('3000'); 
        $tarif1->setT4('8.00'); 
        $tarif1->setP4('5000'); 
        $tarif1->setT5('10.50'); 
        $tarif1->setP5('7000'); 
        $tarif1->setT6('12.75'); 
        $tarif1->setP6('10000'); 
        $tarif1->setT7('15.35'); 
        $tarif1->setP7('15000'); 
        $tarif1->setT8('19.10'); 
        $tarif1->setP8('30000'); 
        $tarif1->setT9('88888.88'); 
        $tarif1->setP9('88888888'); 
        $tarif1->setT10('88888.88'); 
        $manager->persist($tarif3);

        $tarif4 = new Tarif(); //Font suite les setters des champs à définir
        $tarif1->setNom('colis'); 
        $tarif1->setOrg('Mondial Relay');
        $tarif1->setImg('img/mRelay.png');
        $tarif1->setTypPays('1'); 
        $tarif1->setAnnee('2017'); 
        $tarif1->setMaxdim('150'); 
        $tarif1->setMaxepais('8888'); 
        $tarif1->setT0('4.55'); 
        $tarif1->setP0('500');
        $tarif1->setT1('5.25'); 
        $tarif1->setP1('1000'); 
        $tarif1->setT2('5.95'); 
        $tarif1->setP2('2000'); 
        $tarif1->setT3('6.80'); 
        $tarif1->setP3('3000'); 
        $tarif1->setT4('8.00'); 
        $tarif1->setP4('5000'); 
        $tarif1->setT5('10.50'); 
        $tarif1->setP5('7000'); 
        $tarif1->setT6('12.75'); 
        $tarif1->setP6('10000'); 
        $tarif1->setT7('15.35'); 
        $tarif1->setP7('15000'); 
        $tarif1->setT8('19.10'); 
        $tarif1->setP8('30000'); 
        $tarif1->setT9('88888.88'); 
        $tarif1->setP9('88888888'); 
        $tarif1->setT10('88888.88'); 
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