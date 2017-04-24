<?php

namespace DV\EcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromoCmde
 *
 * @ORM\Table("promocmdes")
 * @ORM\Entity(repositoryClass="DV\EcomBundle\Repository\PromoCmdesRepository")
 */
class PromoCmdes
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
     * @var \DateTime
     *
     * @ORM\Column(name="datedeb", type="datetime")
     */
    private $datedeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="datetime")
     */
    private $datefin;

    /**
     * @var float
     *
     * @ORM\Column(name="remise_pourcent", type="float")
     */
    private $remisePourcent;

    /**
     * @var float
     *
     * @ORM\Column(name="remise_euro", type="float")
     */
    private $remiseEuro;

    /**
     * @var float
     *
     * @ORM\Column(name="frlivrgratuit", type="float")
     */
    private $frlivrgratuit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="apartirdemontant", type="boolean")
     */
    private $apartirdemontant;

    /**
     * @var string
     *
     * @ORM\Column(name="codepromo", type="string", length=50)
     */
    private $codepromo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="affiche_pub", type="boolean")
     */
    private $affichePub;

    /**
     * @var string
     *
     * @ORM\Column(name="article_pub", type="text")
     */
    private $articlePub;

    /**
     * @var string
     *
     * @ORM\Column(name="image_pub", type="string", length=255)
     */
    private $imagePub;


    /**
    * @ORM\ManyToOne(targetEntity="DV\EcomBundle\Entity\Commandes", inversedBy="promoCmde")
    * @ORM\JoinColumn(nullable=false)
    */
     private $comande ;

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
     * @return PromoCmde
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
     * Set datedeb
     *
     * @param \DateTime $datedeb
     *
     * @return PromoCmde
     */
    public function setDatedeb($datedeb)
    {
        $this->datedeb = $datedeb;

        return $this;
    }

    /**
     * Get datedeb
     *
     * @return \DateTime
     */
    public function getDatedeb()
    {
        return $this->datedeb;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return PromoCmde
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set remisePourcent
     *
     * @param float $remisePourcent
     *
     * @return PromoCmde
     */
    public function setRemisePourcent($remisePourcent)
    {
        $this->remisePourcent = $remisePourcent;

        return $this;
    }

    /**
     * Get remisePourcent
     *
     * @return float
     */
    public function getRemisePourcent()
    {
        return $this->remisePourcent;
    }

    /**
     * Set remiseEuro
     *
     * @param float $remiseEuro
     *
     * @return PromoCmde
     */
    public function setRemiseEuro($remiseEuro)
    {
        $this->remiseEuro = $remiseEuro;

        return $this;
    }

    /**
     * Get remiseEuro
     *
     * @return float
     */
    public function getRemiseEuro()
    {
        return $this->remiseEuro;
    }

    /**
     * Set frlivrgratuit
     *
     * @param float $frlivrgratuit
     *
     * @return PromoCmde
     */
    public function setFrlivrgratuit($frlivrgratuit)
    {
        $this->frlivrgratuit = $frlivrgratuit;

        return $this;
    }

    /**
     * Get frlivrgratuit
     *
     * @return float
     */
    public function getFrlivrgratuit()
    {
        return $this->frlivrgratuit;
    }

    /**
     * Set apartirdemontant
     *
     * @param boolean $apartirdemontant
     *
     * @return PromoCmde
     */
    public function setApartirdemontant($apartirdemontant)
    {
        $this->apartirdemontant = $apartirdemontant;

        return $this;
    }

    /**
     * Get apartirdemontant
     *
     * @return boolean
     */
    public function getApartirdemontant()
    {
        return $this->apartirdemontant;
    }

    /**
     * Set codepromo
     *
     * @param string $codepromo
     *
     * @return PromoProd
     */
    public function setCodepromo($codepromo)
    {
        $this->codepromo = $codepromo;

        return $this;
    }

    /**
     * Get codepromo
     *
     * @return string
     */
    public function getCodepromo()
    {
        return $this->codepromo;
    }

    /**
     * Set affichePub
     *
     * @param boolean $affichePub
     *
     * @return PromoProd
     */
    public function setAffichePub($affichePub)
    {
        $this->affichePub = $affichePub;

        return $this;
    }

    /**
     * Get affichePub
     *
     * @return boolean
     */
    public function getAffichePub()
    {
        return $this->affichePub;
    }
    
    /**
     * Set articlePub
     *
     * @param string $articlePub
     *
     * @return PromoCmde
     */
    public function setArticlePub($articlePub)
    {
        $this->articlePub = $articlePub;

        return $this;
    }

    /**
     * Get articlePub
     *
     * @return string
     */
    public function getArticlePub()
    {
        return $this->articlePub;
    }

    /**
     * Set imagePub
     *
     * @param string $imagePub
     *
     * @return PromoCmde
     */
    public function setImagePub($imagePub)
    {
        $this->imagePub = $imagePub;

        return $this;
    }

    /**
     * Get imagePub
     *
     * @return string
     */
    public function getImagePub()
    {
        return $this->imagePub;
    }

    /**
     * Set comande
     *
     * @param \DV\EcomBundle\Entity\Commandes $comande
     *
     * @return PromoCmdes
     */
    public function setComande(\DV\EcomBundle\Entity\Commandes $comande)
    {
        $this->comande = $comande;

        return $this;
    }

    /**
     * Get comande
     *
     * @return \DV\EcomBundle\Entity\Commandes
     */
    public function getComande()
    {
        return $this->comande;
    }
}
