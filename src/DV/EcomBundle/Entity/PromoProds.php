<?php

namespace DV\EcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromoProd
 *
 * @ORM\Table("promoprods")
 * @ORM\Entity(repositoryClass="DV\EcomBundle\Repository\PromoProdsRepository")
 */
class PromoProds
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
     * @ORM\Column(name="nom", type="string", length=150)
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

    public function __construct()
    {
        $this->datedeb = new \DateTime();
        $this->datefin = $this->datedeb;
    }

    /**
     * @var float
     *
     * @ORM\Column(name="remise_pourcent", type="float", nullable=true)
     */
    private $remisePourcent;

    /**
     * @var float
     *
     * @ORM\Column(name="remise_euro", type="float", nullable=true)
     */
    private $remiseEuro;

    /**
     * @var integer
     *
     * @ORM\Column(name="apartirdeqte", type="integer")
     */
    private $apartirdeqte;

    /**
     * @var string
     *
     * @ORM\Column(name="codepromo", type="string", length=50, nullable=true)
     */
    private $codepromo;

    /**
     * @var integer
     *
     * @ORM\Column(name="affiche_pub", type="integer")
     */
    private $affichePub;

    /**
     * @var string
     *
     * @ORM\Column(name="article_pub", type="text", nullable=true)
     */
    private $articlePub;

    /**
     * @var string
     *
     * @ORM\Column(name="image_pub", type="string", length=125, nullable=true)
     */
    private $imagePub;

    /**
     * @var string
     *
     * @ORM\Column(name="bandeau_pub", type="string", length=125, nullable=true)
     */
    private $bandeauPub;

    /**
    * @ORM\ManyToOne(targetEntity="DV\EcomBundle\Entity\Produits", inversedBy="promoProd")
    * @ORM\JoinColumn(nullable=false)
    */
     private $produit ;

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
     * @return PromoProd
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
     * @return PromoProd
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
     * @return PromoProd
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
     * @return PromoProd
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
     * @return PromoProd
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
     * Set apartirdeqte
     *
     * @param integer $apartirdeqte
     *
     * @return PromoProd
     */
    public function setApartirdeqte($apartirdeqte)
    {
        $this->apartirdeqte = $apartirdeqte;

        return $this;
    }

    /**
     * Get apartirdeqte
     *
     * @return integer
     */
    public function getApartirdeqte()
    {
        return $this->apartirdeqte;
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
     * @param integer $affichePub
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
     * @return integer
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
     * @return PromoProd
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
     * @return PromoProd
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
     * Set bandeauPub
     *
     * @param string $bandeauPub
     *
     * @return PromoProd
     */
    public function setBandeauPub($bandeauPub)
    {
        $this->bandeauPub = $bandeauPub;

        return $this;
    }

    /**
     * Get bandeauPub
     *
     * @return string
     */
    public function getBandeauPub()
    {
        return $this->bandeauPub;
    }

    /**
     * Set produit
     *
     * @param \DV\EcomBundle\Entity\Produits $produit
     *
     * @return PromoProds
     */
    public function setProduit(\DV\EcomBundle\Entity\Produits $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \DV\EcomBundle\Entity\Produits
     */
    public function getProduit()
    {
        return $this->produit;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}

