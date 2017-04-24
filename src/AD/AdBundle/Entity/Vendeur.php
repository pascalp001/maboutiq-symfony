<?php

namespace AD\AdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vendeur
 *
 * @ORM\Table("vendeur")
 * @ORM\Entity(repositoryClass="AD\AdBundle\Repository\VendeurRepository")
 */
class Vendeur
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
     * @ORM\Column(name="nomcomplet", type="string", length=255)
     */
    private $nomcomplet;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="urlLogo", type="string", length=255, nullable=true)
     */
    private $urllogo0;

    /**
     * @var string
     *
     * @ORM\Column(name="urlLogo1", type="string", length=255, nullable=true)
     */
    private $urllogo1;

    /**
     * @var string
     *
     * @ORM\Column(name="urlLogo2", type="string", length=255, nullable=true)
     */
    private $urllogo2;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse1", type="string", length=255)
     */
    private $adresse1;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse2", type="string", length=255, nullable=true)
     */
    private $adresse2;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Banque", type="string", length=255, nullable=true)
     */
    private $banque;

    /**
     * @var string
     *
     * @ORM\Column(name="comptebanc", type="string", length=255, nullable=true)
     */
    private $comptebanc;

    /**
     * @var string
     *
     * @ORM\Column(name="iban", type="string", length=255, nullable=true)
     */
    private $iban;

    /**
     * @var string
     *
     * @ORM\Column(name="bic", type="string", length=255, nullable=true)
     */
    private $bic;

    /**
     * @var string
     *
     * @ORM\Column(name="syssecur", type="string", length=255, nullable=true)
     */
    private $syssecur;

    /**
     * @var string
     *
     * @ORM\Column(name="nombqsecur", type="string", length=255, nullable=true)
     */
    private $nombqsecur;

    /**
     * @var string
     *
     * @ORM\Column(name="urlbq", type="string", length=255, nullable=true)
     */
    private $urlbq;

    /**
     * @var string
     *
     * @ORM\Column(name="numerocnil", type="string", length=255, nullable=true)
     */
    private $numerocnil;

    /**
     * @var string
     *
     * @ORM\Column(name="numsiret", type="string", length=255, nullable=true)
     */
    private $numsiret;

    /**
     * @var string
     *
     * @ORM\Column(name="greffe", type="string", length=255, nullable=true)
     */
    private $greffe;

    /**
     * @var string
     *
     * @ORM\Column(name="divers", type="string", length=255, nullable=true)
     */
    private $divers;

    /**
     * @var string
     *
     * @ORM\Column(name="concepteur", type="string", length=255, nullable=true)
     */
    private $concepteur;

    /**
     * @var string
     *
     * @ORM\Column(name="editeur", type="string", length=255, nullable=true)
     */
    private $editeur;

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
     * Set nomcomplet
     *
     * @param string $nomcomplet
     *
     * @return Vendeur
     */
    public function setNomcomplet($nomcomplet)
    {
        $this->nomcomplet = $nomcomplet;

        return $this;
    }

    /**
     * Get nomcomplet
     *
     * @return string
     */
    public function getNomcomplet()
    {
        return $this->nomcomplet;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Vendeur
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
     * Set adresse1
     *
     * @param string $adresse1
     *
     * @return Vendeur
     */
    public function setAdresse1($adresse1)
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    /**
     * Get adresse1
     *
     * @return string
     */
    public function getAdresse1()
    {
        return $this->adresse1;
    }

    /**
     * Set adresse2
     *
     * @param string $adresse2
     *
     * @return Vendeur
     */
    public function setAdresse2($adresse2)
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    /**
     * Get adresse2
     *
     * @return string
     */
    public function getAdresse2()
    {
        return $this->adresse2;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return Vendeur
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
     * @return Vendeur
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
     * @return Vendeur
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
     * @return Vendeur
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
     * Set email
     *
     * @param string $email
     *
     * @return Vendeur
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
     * Set banque
     *
     * @param string $banque
     *
     * @return Vendeur
     */
    public function setBanque($banque)
    {
        $this->banque = $banque;

        return $this;
    }

    /**
     * Get banque
     *
     * @return string
     */
    public function getBanque()
    {
        return $this->banque;
    }

    /**
     * Set comptebanc
     *
     * @param string $comptebanc
     *
     * @return Vendeur
     */
    public function setComptebanc($comptebanc)
    {
        $this->comptebanc = $comptebanc;

        return $this;
    }

    /**
     * Get comptebanc
     *
     * @return string
     */
    public function getComptebanc()
    {
        return $this->comptebanc;
    }

    /**
     * Set iban
     *
     * @param string $iban
     *
     * @return Vendeur
     */
    public function setIban($iban)
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * Get iban
     *
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set bic
     *
     * @param string $bic
     *
     * @return Vendeur
     */
    public function setBic($bic)
    {
        $this->bic = $bic;

        return $this;
    }

    /**
     * Get bic
     *
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * Set syssecur
     *
     * @param string $syssecur
     *
     * @return Vendeur
     */
    public function setSyssecur($syssecur)
    {
        $this->syssecur = $syssecur;

        return $this;
    }

    /**
     * Get syssecur
     *
     * @return string
     */
    public function getSyssecur()
    {
        return $this->syssecur;
    }

    /**
     * Set nombqsecur
     *
     * @param string $nombqsecur
     *
     * @return Vendeur
     */
    public function setNombqsecur($nombqsecur)
    {
        $this->nombqsecur = $nombqsecur;

        return $this;
    }

    /**
     * Get nombqsecur
     *
     * @return string
     */
    public function getNombqsecur()
    {
        return $this->nombqsecur;
    }

    /**
     * Set urlbq
     *
     * @param string $urlbq
     *
     * @return Vendeur
     */
    public function setUrlbq($urlbq)
    {
        $this->urlbq = $urlbq;

        return $this;
    }

    /**
     * Get urlbq
     *
     * @return string
     */
    public function getUrlbq()
    {
        return $this->urlbq;
    }

    /**
     * Set numerocnil
     *
     * @param string $numerocnil
     *
     * @return Vendeur
     */
    public function setNumerocnil($numerocnil)
    {
        $this->numerocnil = $numerocnil;

        return $this;
    }

    /**
     * Get numerocnil
     *
     * @return string
     */
    public function getNumerocnil()
    {
        return $this->numerocnil;
    }

    /**
     * Set numsiret
     *
     * @param string $numsiret
     *
     * @return Vendeur
     */
    public function setNumsiret($numsiret)
    {
        $this->numsiret = $numsiret;

        return $this;
    }

    /**
     * Get numsiret
     *
     * @return string
     */
    public function getNumsiret()
    {
        return $this->numsiret;
    }

    /**
     * Set greffe
     *
     * @param string $greffe
     *
     * @return Vendeur
     */
    public function setGreffe($greffe)
    {
        $this->greffe = $greffe;

        return $this;
    }

    /**
     * Get greffe
     *
     * @return string
     */
    public function getGreffe()
    {
        return $this->greffe;
    }

    /**
     * Set divers
     *
     * @param string $divers
     *
     * @return Vendeur
     */
    public function setDivers($divers)
    {
        $this->divers = $divers;

        return $this;
    }

    /**
     * Get divers
     *
     * @return string
     */
    public function getDivers()
    {
        return $this->divers;
    }

    /**
     * Set urllogo0
     *
     * @param string $urllogo0
     *
     * @return Vendeur
     */
    public function setUrllogo0($urllogo0)
    {
        $this->urllogo0 = $urllogo0;

        return $this;
    }

    /**
     * Get urllogo0
     *
     * @return string
     */
    public function getUrllogo0()
    {
        return $this->urllogo0;
    }

    /**
     * Set urllogo1
     *
     * @param string $urllogo1
     *
     * @return Vendeur
     */
    public function setUrllogo1($urllogo1)
    {
        $this->urllogo1 = $urllogo1;

        return $this;
    }

    /**
     * Get urllogo1
     *
     * @return string
     */
    public function getUrllogo1()
    {
        return $this->urllogo1;
    }

    /**
     * Set urllogo2
     *
     * @param string $urllogo2
     *
     * @return Vendeur
     */
    public function setUrllogo2($urllogo2)
    {
        $this->urllogo2 = $urllogo2;

        return $this;
    }

    /**
     * Get urllogo2
     *
     * @return string
     */
    public function getUrllogo2()
    {
        return $this->urllogo2;
    }

    /**
     * Set concepteur
     *
     * @param string $concepteur
     *
     * @return Vendeur
     */
    public function setConcepteur($concepteur)
    {
        $this->concepteur = $concepteur;

        return $this;
    }

    /**
     * Get concepteur
     *
     * @return string
     */
    public function getConcepteur()
    {
        return $this->concepteur;
    }

    /**
     * Set editeur
     *
     * @param string $editeur
     *
     * @return Vendeur
     */
    public function setEditeur($editeur)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get editeur
     *
     * @return string
     */
    public function getEditeur()
    {
        return $this->editeur;
    }
}
