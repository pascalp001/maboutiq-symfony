<?php

namespace DV\EcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commandes
 *
 * @ORM\Table("commandes")
 * @ORM\Entity(repositoryClass="DV\EcomBundle\Repository\CommandesRepository")
 */
class Commandes
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
    * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs", inversedBy="commandes")
    * @ORM\JoinColumn(nullable=false)
    */
     private $utilisateur ;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valider", type="boolean")
     */
    private $valider;

    /**
     * @var boolean
     *
     * @ORM\Column(name="payer", type="boolean")
     */
    private $payer;

    /**
     * @var integer
     *
     * @ORM\Column(name="modpmt", type="integer")
     */
    private $modpmt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="preparer", type="boolean")
     */
    private $preparer;

    /**
     * @var boolean
     *
     * @ORM\Column(name="livrer", type="boolean")
     */
    private $livrer;

    /**
     * @var boolean
     *
     * @ORM\Column(name="archiver", type="boolean")
     */
    private $archiver;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="reference", type="integer")
     */
    private $reference;

    /**
     * @var array
     *
     * @ORM\Column(name="commande", type="array")
     */
    private $commande;

    /**
    * @ORM\OneToMany(targetEntity="DV\EcomBundle\Entity\PromoCmdes", mappedBy="comande", cascade={"persist"} )
    * @ORM\JoinColumn(nullable=true)
    */
     private $promoCmde ;

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Commandes
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reference
     *
     * @param integer $reference
     *
     * @return Commandes
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return integer
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set commande
     *
     * @param array $commande
     *
     * @return Commandes
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return array
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set utilisateur
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $utilisateur
     *
     * @return Commandes
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
     * Set valider
     *
     * @param boolean $valider
     *
     * @return Commandes
     */
    public function setValider($valider)
    {
        $this->valider = $valider;

        return $this;
    }

    /**
     * Get valider
     *
     * @return boolean
     */
    public function getValider()
    {
        return $this->valider;
    }


    /**
     * Set payer
     *
     * @param boolean $payer
     *
     * @return Commandes
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * Get payer
     *
     * @return boolean
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * Set modpmt
     *
     * @param integer $modpmt
     *
     * @return Commandes
     */
    public function setModpmt($modpmt)
    {
        $this->modpmt = $modpmt;

        return $this;
    }

    /**
     * Get modpmt
     *
     * @return integer
     */
    public function getModpmt()
    {
        return $this->modpmt;
    }

    /**
     * Set preparer
     *
     * @param boolean $preparer
     *
     * @return Commandes
     */
    public function setPreparer($preparer)
    {
        $this->preparer = $preparer;

        return $this;
    }

    /**
     * Get preparer
     *
     * @return boolean
     */
    public function getPreparer()
    {
        return $this->preparer;
    }
    /**
     * Set livrer
     *
     * @param boolean $livrer
     *
     * @return Commandes
     */
    public function setLivrer($livrer)
    {
        $this->livrer = $livrer;

        return $this;
    }

    /**
     * Get livrer
     *
     * @return boolean
     */
    public function getLivrer()
    {
        return $this->livrer;
    }

    /**
     * Set archiver
     *
     * @param boolean $archiver
     *
     * @return Commandes
     */
    public function setArchiver($archiver)
    {
        $this->archiver = $archiver;

        return $this;
    }

    /**
     * Get archiver
     *
     * @return boolean
     */
    public function getArchiver()
    {
        return $this->archiver;
    }

    public function __toString()
    {
        return $this->getNom();
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->promoCmde = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add promoCmde
     *
     * @param \DV\EcomBundle\Entity\PromoCmdes $promoCmde
     *
     * @return Commandes
     */
    public function addPromoCmde(\DV\EcomBundle\Entity\PromoCmdes $promoCmde)
    {
        $this->promoCmde[] = $promoCmde;

        return $this;
    }

    /**
     * Remove promoCmde
     *
     * @param \DV\EcomBundle\Entity\PromoCmdes $promoCmde
     */
    public function removePromoCmde(\DV\EcomBundle\Entity\PromoCmdes $promoCmde)
    {
        $this->promoCmde->removeElement($promoCmde);
    }

    /**
     * Get promoCmde
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPromoCmde()
    {
        return $this->promoCmde;
    }
}
