<?php

namespace DV\EcomBundle\Entity;


/**
 * PrdReassort
 *
 */
class PrdReassort
{
    /**
     * @var integer
     *
     */
    private $id;
  
    /**
     * @var string
     *
     */
    private $nom;

    /**
     * @var integer
     *
     */
    private $stockreel;

    /**
     * @var boolean
     *
     */
    private $demarque;

    /**
     * @var integer
     *
     */
    private $inventaire;

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return PrdDemarque
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * @return PrdDemarque
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
     * Set stockreel
     *
     * @param integer $stockreel
     *
     * @return PrdDemarque
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
     * Set demarque
     *
     * @param integer $demarque
     *
     * @return PrdDemarque
     */
    public function setDemarque($demarque)
    {
        $this->demarque = $demarque;

        return $this;
    }

    /**
     * Get demarque
     *
     * @return integer
     */
    public function getDemarque()
    {
        return $this->demarque;
    }
    /**
     * Set inventaire
     *
     * @param integer $inventaire
     *
     * @return PrdDemarque
     */
    public function setInventaire($inventaire)
    {
        $this->inventaire = $inventaire;

        return $this;
    }

    /**
     * Get inventaire
     *
     * @return integer
     */
    public function getInventaire()
    {
        return $this->inventaire;
    }

}