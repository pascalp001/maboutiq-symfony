<?php

namespace AD\AdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseurs
 *
 * @ORM\Table("fournisseurs")
 * @ORM\Entity(repositoryClass="AD\AdBundle\Repository\FournisseursRepository")
 */
class Fournisseurs
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=125)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=125, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=125, nullable=true)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=125, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=125, nullable=true)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=125, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=125, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=125, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="commercial", type="string", length=125, nullable=true)
     */
    private $commercial;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_commerc", type="string", length=125, nullable=true)
     */
    private $tel_commerc;

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
     * @return Fournisseurs
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Fournisseurs
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
     * @return Fournisseurs
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
     * @return Fournisseurs
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
     * @return Fournisseurs
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
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Fournisseurs
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
     * Set fax
     *
     * @param string $fax
     *
     * @return Fournisseurs
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Fournisseurs
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set commercial
     *
     * @param string $commercial
     *
     * @return Fournisseurs
     */
    public function setCommercial($commercial)
    {
        $this->commercial = $commercial;

        return $this;
    }

    /**
     * Get commercial
     *
     * @return string
     */
    public function getCommercial()
    {
        return $this->commercial;
    }

    /**
     * Set telCommerc
     *
     * @param string $telCommerc
     *
     * @return Fournisseurs
     */
    public function setTelCommerc($telCommerc)
    {
        $this->tel_commerc = $telCommerc;

        return $this;
    }

    /**
     * Get telCommerc
     *
     * @return string
     */
    public function getTelCommerc()
    {
        return $this->tel_commerc;
    }
    
    public function __toString()
    {
        return $this->getNom();
    }
}
