<?php

namespace DV\EcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table("avis")
 * @ORM\Entity(repositoryClass="DV\EcomBundle\Repository\AvisRepository")
 */
class Avis
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
    * @ORM\ManyToOne(targetEntity="DV\EcomBundle\Entity\Produits", inversedBy="avi")
    * @ORM\JoinColumn(nullable=false)
    */
     private $produit ;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=140)
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="stars", type="integer")
     */
    private $stars;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=140)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=4000)
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="valid", type="smallint")
     */
    private $valid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * Set stars
     *
     * @param integer $stars
     *
     * @return Avis
     */
    public function setStars($stars)
    {
        $this->stars = $stars;

        return $this;
    }

    /**
     * Get stars
     *
     * @return integer
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Avis
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Avis
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set valid
     *
     * @param integer $valid
     *
     * @return Avis
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get valid
     *
     * @return integer
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Avis
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
     * Set produit
     *
     * @param \DV\EcomBundle\Entity\Produits $produit
     *
     * @return Avis
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

    /**
     * Set user
     *
     * @param string $user
     *
     * @return Avis
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }
}
