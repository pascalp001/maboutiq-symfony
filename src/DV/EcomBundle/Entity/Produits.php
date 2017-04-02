<?php

namespace DV\EcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produits
 *
 * @ORM\Table("produits")
 * @ORM\Entity(repositoryClass="DV\EcomBundle\Repository\ProduitsRepository")
 */
class Produits
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
    * @ORM\OneToOne(targetEntity="DV\EcomBundle\Entity\Media", cascade={"persist","remove"} )
    * @ORM\JoinColumn(nullable=false)
    */
     private $image ;

    /**
    * @ORM\ManyToOne(targetEntity="DV\EcomBundle\Entity\Tva", cascade={"persist"} )
    * @ORM\JoinColumn(nullable=false)
    */
     private $tva ;

    /**
    * @ORM\ManyToOne(targetEntity="DV\EcomBundle\Entity\Categories", cascade={"persist"} )
    * @ORM\JoinColumn(nullable=false)
    */
     private $categorie ;

    /**
    * @ORM\ManyToOne(targetEntity="AD\AdBundle\Entity\Fournisseurs", cascade={"persist"} )
    * @ORM\JoinColumn(nullable=true)
    */
     private $fournisseur ;

    /**
    * @ORM\OneToMany(targetEntity="DV\EcomBundle\Entity\Avis", mappedBy="produit", cascade={"persist","remove"} )
    * @ORM\JoinColumn(nullable=true)
    */
     private $avi ;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcourt", type="text")
     */
    private $descripcourt;

    /**
     * @var string
     *
     * @ORM\Column(name="donneestech", type="text", nullable=true)
     */
    private $donneestech;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="poids", type="integer")
     */
    private $poids;

    /**
     * @var float
     *
     * @ORM\Column(name="taille", type="float", nullable=true)
     */
    private $taille;

    /**
     * @var float
     *
     * @ORM\Column(name="largeur", type="float", nullable=true)
     */
    private $largeur;

    /**
     * @var float
     *
     * @ORM\Column(name="epaiss", type="float", nullable=true)
     */
    private $epaiss;

    /**
     * @var integer
     *
     * @ORM\Column(name="popularite", type="integer")
     */
    private $popularite;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disponible", type="boolean")
     */
    private $disponible;

    /**
     * @var integer
     *
     * @ORM\Column(name="stockreel", type="integer")
     */
    private $stockreel;

    /**
     * @var integer
     *
     * @ORM\Column(name="stockvirtuel", type="integer")
     */
    private $stockvirtuel;

    /**
     * @var integer
     *
     * @ORM\Column(name="stockinventaire", type="integer", nullable=true)
     */
    private $stockinventaire;

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
     * @return Produits
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
     * Set description
     *
     * @param string $description
     * @return Produits
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Produits
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     * @return Produits
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean 
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set categorieId
     *
     * @param string $categorieId
     * @return Produits
     */
    public function setCategorieId($categorieId)
    {
        $this->categorieId = $categorieId;

        return $this;
    }

    /**
     * Get categorieId
     *
     * @return string 
     */
    public function getCategorieId()
    {
        return $this->categorieId;
    }

    /**
     * Set imageId
     *
     * @param string $imageId
     * @return Produits
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;

        return $this;
    }

    /**
     * Get imageId
     *
     * @return string 
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * Set tva
     *
     * @param float $tva
     * @return Produits
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return float 
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set image
     *
     * @param \DV\EcomBundle\Entity\Media $image
     *
     * @return Produits
     */
    public function setImage(\DV\EcomBundle\Entity\Media $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \DV\EcomBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set categorie
     *
     * @param \DV\EcomBundle\Entity\Categories $categories
     *
     * @return Produits
     */
    public function setCategorie(\DV\EcomBundle\Entity\Categories $categories)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \DV\EcomBundle\Entity\Categories
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set fournisseur
     *
     * @param \DV\EcomBundle\Entity\Fournisseurs $fournisseur
     *
     * @return Produits
     */
    public function setFournisseur(\AD\AdBundle\Entity\Fournisseurs $fournisseur)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \DV\EcomBundle\Entity\Fournisseurs
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set descripcourt
     *
     * @param string $descripcourt
     *
     * @return Produits
     */
    public function setDescripcourt($descripcourt)
    {
        $this->descripcourt = $descripcourt;

        return $this;
    }

    /**
     * Get descripcourt
     *
     * @return string
     */
    public function getDescripcourt()
    {
        return $this->descripcourt;
    }

    /**
     * Set donneestech
     *
     * @param string $donneestech
     *
     * @return Produits
     */
    public function setDonneestech($donneestech)
    {
        $this->donneestech = $donneestech;

        return $this;
    }

    /**
     * Get donneestech
     *
     * @return string
     */
    public function getDonneestech()
    {
        return $this->donneestech;
    }

    /**
     * Set poids
     *
     * @param integer $poids
     *
     * @return Produits
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return integer
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set taille
     *
     * @param float $taille
     *
     * @return Produits
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return float
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set largeur
     *
     * @param float $largeur
     *
     * @return Produits
     */
    public function setLargeur($largeur)
    {
        $this->largeur = $largeur;

        return $this;
    }

    /**
     * Get largeur
     *
     * @return float
     */
    public function getLargeur()
    {
        return $this->largeur;
    }

    /**
     * Set epaiss
     *
     * @param float $epaiss
     *
     * @return Produits
     */
    public function setEpaiss($epaiss)
    {
        $this->epaiss = $epaiss;

        return $this;
    }

    /**
     * Get epaiss
     *
     * @return float
     */
    public function getEpaiss()
    {
        return $this->epaiss;
    }

    /**
     * Set popularite
     *
     * @param integer $popularite
     *
     * @return Produits
     */
    public function setPopularite($popularite)
    {
        $this->popularite = $popularite;

        return $this;
    }

    /**
     * Get popularite
     *
     * @return integer
     */
    public function getPopularite()
    {
        return $this->popularite;
    }

    /**
     * Set stockreel
     *
     * @param integer $stockreel
     *
     * @return Produits
     */
    public function setStockreel($stockreel)
    {
        $this->stockreel = $stockreel;

        return $this;
    }

    /**
     * Get stockreel
     *
     * @return integer
     */
    public function getStockreel()
    {
        return $this->stockreel;
    }

    /**
     * Set stockvirtuel
     *
     * @param integer $stockvirtuel
     *
     * @return Produits
     */
    public function setStockvirtuel($stockvirtuel)
    {
        $this->stockvirtuel = $stockvirtuel;

        return $this;
    }

    /**
     * Get stockvirtuel
     *
     * @return integer
     */
    public function getStockvirtuel()
    {
        return $this->stockvirtuel;
    }

    /**
     * Set stockinventaire
     *
     * @param integer $stockinventaire
     *
     * @return Produits
     */
    public function setStockinventaire($stockinventaire)
    {
        $this->stockinventaire = $stockinventaire;

        return $this;
    }

    /**
     * Get stockinventaire
     *
     * @return integer
     */
    public function getStockinventaire()
    {
        return $this->stockinventaire;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->avi = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add avi
     *
     * @param \DV\EcomBundle\Entity\Avis $avi
     *
     * @return Produits
     */
    public function addAvi(\DV\EcomBundle\Entity\Avis $avi)
    {
        $this->avi[] = $avi;

        return $this;
    }

    /**
     * Remove avi
     *
     * @param \DV\EcomBundle\Entity\Avis $avi
     */
    public function removeAvi(\DV\EcomBundle\Entity\Avis $avi)
    {
        $this->avi->removeElement($avi);
    }

    /**
     * Get avi
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAvi()
    {
        return $this->avi;
    }


}
