<?php

namespace AD\AdBundle\Entity;


/**
 * PrdReassort
 *
 */
class PrdDemarque
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
    private $casse;

    /**
     * @var boolean
     *
     */
    private $defect;

    /**
     * @var boolean
     *
     */
    private $autre;

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
     * Set casse
     *
     * @param integer $casse
     *
     * @return PrdDemarque
     */
    public function setCasse($casse)
    {
        $this->casse = $casse;

        return $this;
    }

    /**
     * Get casse
     *
     * @return integer
     */
    public function getCasse()
    {
        return $this->casse;
    }

    /**
     * Set defect
     *
     * @param integer $defect
     *
     * @return PrdDemarque
     */
    public function setDefect($defect)
    {
        $this->defect = $defect;

        return $this;
    }

    /**
     * Get defect
     *
     * @return integer
     */
    public function getDefect()
    {
        return $this->defect;
    }
    
    /**
     * Set autre
     *
     * @param integer $autre
     *
     * @return PrdDemarque
     */
    public function setAutre($autre)
    {
        $this->autre = $autre;

        return $this;
    }

    /**
     * Get autre
     *
     * @return integer
     */
    public function getAutre()
    {
        return $this->autre;
    }

}