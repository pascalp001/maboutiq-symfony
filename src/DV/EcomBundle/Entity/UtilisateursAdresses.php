<?php

namespace DV\EcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtilisateursAdresses
 *
 * @ORM\Table("utilisateursadresses")
 * @ORM\Entity(repositoryClass="DV\EcomBundle\Repository\UtilisateursAdressesRepository")
 */
class UtilisateursAdresses
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs", inversedBy="adresses")
    * @ORM\JoinColumn(nullable=false)
    */
     private $utilisateur ;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=125)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=50)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=125)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=125, nullable=true)
     */
    private $complement;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=50)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=125)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=125)
     */
    private $pays;


    /**
     * @var boolean
     *
     * @ORM\Column(name="fact", type="boolean")
     */
    private $fact;


    /**
     * @var boolean
     *
     * @ORM\Column(name="livr", type="boolean")
     */
    private $livr;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return UtilisateursAdresses
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
     * @return UtilisateursAdresses
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
     * @return UtilisateursAdresses
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return UtilisateursAdresses
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return UtilisateursAdresses
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

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return UtilisateursAdresses
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return UtilisateursAdresses
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set complement
     *
     * @param string $complement
     *
     * @return UtilisateursAdresses
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set utilisateur
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $utilisateur
     *
     * @return UtilisateursAdresses
     */
    public function setUtilisateur(\Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set fact
     *
     * @param boolean $fact
     *
     * @return UtilisateursAdresses
     */
    public function setFact($fact)
    {
        $this->fact = $fact;

        return $this;
    }

    /**
     * Get fact
     *
     * @return boolean
     */
    public function getFact()
    {
        return $this->fact;
    }

    /**
     * Set livr
     *
     * @param boolean $livr
     *
     * @return UtilisateursAdresses
     */
    public function setLivr($livr)
    {
        $this->livr = $livr;

        return $this;
    }

    /**
     * Get livr
     *
     * @return boolean
     */
    public function getLivr()
    {
        return $this->livr;
    }
}
