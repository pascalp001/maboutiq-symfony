<?php
namespace Pages\PagesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pages\PagesBundle\Entity\Pages;

class PagesData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $page1 = new Pages(); //Font suite les setters des champs à définir
        $page1->setTitre('CGV'); 
        $page1->setContenu('
            <div class="row">
                <h4>Item Brand and Category</h4>
                <h5>AB29837 Item Model</h5>
                <p>Lorem Ipsum ... ... </p>
            </div>
            <div class="row">
                <h4>Item Brand and Category</h4>
                <h5>AB29837 Item Model</h5>
                <p>Lorem Ipsum ... ... </p>
            </div>
                '); 
        $manager->persist($page1);

        $page2 = new Pages(); //Font suite les setters des champs à définir
        $page2->setTitre('Mentions legales'); 
        $page2->setContenu('Ceci est le contenu de ma deuxième page annexe'); 
        $manager->persist($page2);

        $manager->flush();
    }

}
?>