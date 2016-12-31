<?php
namespace Utilisateurs\UtilisateursBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Utilisateurs\UtilisateursBundle\Entity\Utilisateurs;

class UtilisateursData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
    	$this->container  =$container;
    }
  
    public function load(ObjectManager $manager)
    {
        $utilisateurs1 = new Utilisateurs(); //Font suite les setters des champs à définir
        $utilisateurs1->setUsername('geronimo'); 
        $utilisateurs1->setEmail('geronimo@gmail.com'); 
        $utilisateurs1->setEnabled('1'); 
        //$utilisateurs1->setSalt(md5(uniqid()));
        $utilisateurs1->setPassword($this->container->get('security.password_encoder')->encodePassword($utilisateurs1, 'geronipwd'));
        $manager->persist($utilisateurs1);

        $utilisateurs2 = new Utilisateurs(); //Font suite les setters des champs à définir
        $utilisateurs2->setUsername('client'); 
        $utilisateurs2->setEmail('client@gmail.com'); 
        $utilisateurs2->setEnabled('1'); 
        $encoder = $this->container ->get('security.password_encoder')
        							->encodePassword( $utilisateurs2,'client');
        $utilisateurs2->setPassword($encoder);
        $manager->persist($utilisateurs2);

        $utilisateurs3 = new Utilisateurs(); //Font suite les setters des champs à définir
        $utilisateurs3->setUsername('pascalp'); 
        $utilisateurs3->setEmail('pascalp001@free.fr'); 
        $utilisateurs3->setEnabled('1'); 
        $encoder = $this->container ->get('security.password_encoder')
        							->encodePassword( $utilisateurs3,'pascalp');
        $utilisateurs3->setPassword($encoder);
        $manager->persist($utilisateurs3);
        $manager->flush();

        $this->addReference('utilisateurs1', $utilisateurs1);
        $this->addReference('utilisateurs2', $utilisateurs2);
        $this->addReference('utilisateurs3', $utilisateurs3);
    }

     public function getOrder()
    {    return 5;    }

}
?>