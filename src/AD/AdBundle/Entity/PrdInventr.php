<?php

namespace AD\AdBundle\Entity;


/**
 * PrdReassort
 *
 */
class PrdInventr
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
     * @var string
     *
     */
    private $categorie;

    /**
     * @var integer
     *
     */
    private $stockreel;

    /**
     * @var integer
     *
     */
    private $stockinventaire;


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
     * Set categorie
     *
     * @param string $categorie
     *
     * @return PrdDemarque
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
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
     * Set stockinventaire
     *
     * @param integer $stockinventaire
     *
     * @return PrdInventr
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

}