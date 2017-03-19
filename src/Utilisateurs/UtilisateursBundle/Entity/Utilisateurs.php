<?php
// src/AppBundle/Entity/User.php

namespace Utilisateurs\UtilisateursBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Utilisateurs\UtilisateursBundle\Repository\UtilisateursRepository") 
 * @ORM\Table(name="utilisateurs")
 */
class Utilisateurs extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adresses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
    * @ORM\OneToMany (targetEntity="DV\EcomBundle\Entity\Commandes", mappedBy="utilisateur", cascade={"remove"} )
    * @ORM\JoinColumn(nullable=true)
    */
     private $commandes ;

    /**
    * @ORM\OneToMany (targetEntity="DV\EcomBundle\Entity\UtilisateursAdresses", mappedBy="utilisateur", cascade={"remove"} )
    * @ORM\JoinColumn(nullable=true)
    */
     private $adresses ;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=100, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=100, nullable=true)
     */
    private $cp;

    /**
     * Add commande
     *
     * @param \DV\EcomBundle\Entity\Commandes $commande
     *
     * @return Utilisateurs
     */
    public function addCommande(\DV\EcomBundle\Entity\Commandes $commande)
    {
        $this->commandes[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \DV\EcomBundle\Entity\Commandes $commande
     */
    public function removeCommande(\DV\EcomBundle\Entity\Commandes $commande)
    {
        $this->commandes->removeElement($commande);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * Add adress
     *
     * @param \DV\EcomBundle\Entity\UtilisateursAdresses $adress
     *
     * @return Utilisateurs
     */
    public function addAdress(\DV\EcomBundle\Entity\UtilisateursAdresses $adress)
    {
        $this->adresses[] = $adress;

        return $this;
    }

    /**
     * Remove adress
     *
     * @param \DV\EcomBundle\Entity\UtilisateursAdresses $adress
     */
    public function removeAdress(\DV\EcomBundle\Entity\UtilisateursAdresses $adress)
    {
        $this->adresses->removeElement($adress);
    }

    /**
     * Get adresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdresses()
    {
        return $this->adresses;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateurs
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateurs
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Utilisateurs
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return Utilisateurs
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }
}
