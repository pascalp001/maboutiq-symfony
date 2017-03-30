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
    private $popularite;

    /**
     * @var boolean
     *
     */
    private $disponible;

    /**
     * @var integer
     *
     */
    private $stockreel;

    /**
     * @var integer
     *
     */
    private $reassort;

    /**
     * @var integer
     *
     */
    private $stockvirtuel;

    /**
     * @var integer
     *
     */
    private $stockvirtheo;

    /**
     * @var integer
     *
     */
    private $ajust;

    /**
     * @var integer
     *
     */
    private $cmdeV;

    /**
     * @var integer
     *
     */
    private $cmdeV1;

    /**
     * @var integer
     *
     */
    private $cmdeV2;

    /**
     * @var integer
     *
     */
    private $cmdeV3;

    /**
     * @var integer
     *
     */
    private $cmdeV4;

    /**
     * @var integer
     *
     */
    private $cmdeV5;

    /**
     * @var integer
     *
     */
    private $cmdeV6;

    /**
     * @var integer
     *
     */
    private $cmdeV7;

    /**
     * @var integer
     *
     */
    private $cmdeV8;

    /**
     * @var integer
     *
     */
    private $cmdeV9;

    /**
     * @var integer
     *
     */
    private $cmdeV10;

    /**
     * @var integer
     *
     */
    private $cmdeV11;

    /**
     * @var integer
     *
     */
    private $cmdeV12;
    /**
     * @var integer
     *
     */
    private $cmdeP1;

    /**
     * @var integer
     *
     */
    private $cmdeP2;

    /**
     * @var integer
     *
     */
    private $cmdeP3;

    /**
     * @var integer
     *
     */
    private $cmdeP4;

    /**
     * @var integer
     *
     */
    private $cmdeP5;

    /**
     * @var integer
     *
     */
    private $cmdeP6;

    /**
     * @var integer
     *
     */
    private $cmdeP7;

    /**
     * @var integer
     *
     */
    private $cmdeP8;

    /**
     * @var integer
     *
     */
    private $cmdeP9;

    /**
     * @var integer
     *
     */
    private $cmdeP10;

    /**
     * @var integer
     *
     */
    private $cmdeP11;

    /**
     * @var integer
     *
     */
    private $cmdeP12;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return PrdReassort
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
     * @return PrdReassort
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
     * Set popularite
     *
     * @param integer $popularite
     *
     * @return PrdReassort
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
     * Set disponible
     *
     * @param integer $disponible
     *
     * @return PrdReassort
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return integer
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set stockreel
     *
     * @param integer $stockreel
     *
     * @return PrdReassort
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
     * Set reassort
     *
     * @param integer $reassort
     *
     * @return PrdReassort
     */
    public function setReassort($reassort)
    {
        $this->reassort = $reassort;

        return $this;
    }

    /**
     * Get reassort
     *
     * @return integer
     */
    public function getReassort()
    {
        return $this->reassort;
    }

    /**
     * Set stockvirtuel
     *
     * @param integer $stockvirtuel
     *
     * @return PrdReassort
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
     * Set stockvirtheo
     *
     * @param integer $stockvirtheo
     *
     * @return PrdReassort
     */
    public function setStockvirtheo($stockvirtheo)
    {
        $this->stockvirtheo = $stockvirtheo;

        return $this;
    }

    /**
     * Get ajust
     *
     * @return integer
     */
    public function getStockvirtheo()
    {
        return $this->stockvirtheo;
    }
    
    /**
     * Set ajust
     *
     * @param integer $ajust
     *
     * @return PrdReassort
     */
    public function setAjust($ajust)
    {
        $this->ajust = $ajust;

        return $this;
    }

    /**
     * Get ajust
     *
     * @return integer
     */
    public function getAjust()
    {
        return $this->ajust;
    }

    /**
     * Set cmdeV
     *
     * @param integer $cmdeV
     *
     * @return PrdReassort
     */
    public function setCmdeV($cmdeV)
    {
        $this->cmdeV = $cmdeV;

        return $this;
    }

    /**
     * Get cmdeV
     *
     * @return integer
     */
    public function getCmdeV()
    {
        return $this->cmdeV;
    }

    /**
     * Set cmdeV1
     *
     * @param integer $cmdeV1
     *
     * @return PrdReassort
     */
    public function setCmdeV1($cmdeV1)
    {
        $this->cmdeV1 = $cmdeV1;

        return $this;
    }

    /**
     * Get cmdeV1
     *
     * @return integer
     */
    public function getCmdeV1()
    {
        return $this->cmdeV1;
    }

    /**
     * Set cmdeV2
     *
     * @param integer $cmdeV2
     *
     * @return PrdReassort
     */
    public function setCmdeV2($cmdeV2)
    {
        $this->cmdeV2 = $cmdeV2;

        return $this;
    }

    /**
     * Get cmdeV2
     *
     * @return integer
     */
    public function getCmdeV2()
    {
        return $this->cmdeV2;
    }

    /**
     * Set cmdeV3
     *
     * @param integer $cmdeV3
     *
     * @return PrdReassort
     */
    public function setCmdeV3($cmdeV3)
    {
        $this->cmdeV3 = $cmdeV3;

        return $this;
    }

    /**
     * Get cmdeV3
     *
     * @return integer
     */
    public function getCmdeV3()
    {
        return $this->cmdeV3;
    }

    /**
     * Set cmdeV4
     *
     * @param integer $cmdeV4
     *
     * @return PrdReassort
     */
    public function setCmdeV4($cmdeV4)
    {
        $this->cmdeV4 = $cmdeV4;

        return $this;
    }

    /**
     * Get cmdeV4
     *
     * @return integer
     */
    public function getCmdeV4()
    {
        return $this->cmdeV4;
    }

    /**
     * Set cmdeV5
     *
     * @param integer $cmdeV5
     *
     * @return PrdReassort
     */
    public function setCmdeV5($cmdeV5)
    {
        $this->cmdeV5 = $cmdeV5;

        return $this;
    }

    /**
     * Get cmdeV5
     *
     * @return integer
     */
    public function getCmdeV5()
    {
        return $this->cmdeV5;
    }

    /**
     * Set cmdeV6
     *
     * @param integer $cmdeV6
     *
     * @return PrdReassort
     */
    public function setCmdeV6($cmdeV6)
    {
        $this->cmdeV6 = $cmdeV6;

        return $this;
    }

    /**
     * Get cmdeV6
     *
     * @return integer
     */
    public function getCmdeV6()
    {
        return $this->cmdeV6;
    }

    /**
     * Set cmdeV7
     *
     * @param integer $cmdeV7
     *
     * @return PrdReassort
     */
    public function setCmdeV7($cmdeV7)
    {
        $this->cmdeV7 = $cmdeV7;

        return $this;
    }

    /**
     * Get cmdeV7
     *
     * @return integer
     */
    public function getCmdeV7()
    {
        return $this->cmdeV7;
    }

    /**
     * Set cmdeV8
     *
     * @param integer $cmdeV8
     *
     * @return PrdReassort
     */
    public function setCmdeV8($cmdeV8)
    {
        $this->cmdeV8 = $cmdeV8;

        return $this;
    }

    /**
     * Get cmdeV8
     *
     * @return integer
     */
    public function getCmdeV8()
    {
        return $this->cmdeV8;
    }

    /**
     * Set cmdeV9
     *
     * @param integer $cmdeV9
     *
     * @return PrdReassort
     */
    public function setCmdeV9($cmdeV9)
    {
        $this->cmdeV9 = $cmdeV9;

        return $this;
    }

    /**
     * Get cmdeV9
     *
     * @return integer
     */
    public function getCmdeV9()
    {
        return $this->cmdeV9;
    }

    /**
     * Set cmdeV10
     *
     * @param integer $cmdeV10
     *
     * @return PrdReassort
     */
    public function setCmdeV10($cmdeV10)
    {
        $this->cmdeV10 = $cmdeV10;

        return $this;
    }

    /**
     * Get cmdeV10
     *
     * @return integer
     */
    public function getCmdeV10()
    {
        return $this->cmdeV10;
    }

    /**
     * Set cmdeV11
     *
     * @param integer $cmdeV11
     *
     * @return PrdReassort
     */
    public function setCmdeV11($cmdeV11)
    {
        $this->cmdeV11 = $cmdeV11;

        return $this;
    }

    /**
     * Get cmdeV11
     *
     * @return integer
     */
    public function getCmdeV11()
    {
        return $this->cmdeV11;
    }

    /**
     * Set cmdeV12
     *
     * @param integer $cmdeV12
     *
     * @return PrdReassort
     */
    public function setCmdeV12($cmdeV12)
    {
        $this->cmdeV12 = $cmdeV12;

        return $this;
    }

    /**
     * Get cmdeV12
     *
     * @return integer
     */
    public function getCmdeV12()
    {
        return $this->cmdeV12;
    }
    /**
     * Set cmdeP1
     *
     * @param integer $cmdeP1
     *
     * @return PrdReassort
     */
    public function setCmdeP1($cmdeP1)
    {
        $this->cmdeP1 = $cmdeP1;

        return $this;
    }

    /**
     * Get cmdeP1
     *
     * @return integer
     */
    public function getCmdeP1()
    {
        return $this->cmdeP1;
    }

    /**
     * Set cmdeP2
     *
     * @param integer $cmdeP2
     *
     * @return PrdReassort
     */
    public function setCmdeP2($cmdeP2)
    {
        $this->cmdeP2 = $cmdeP2;

        return $this;
    }

    /**
     * Get cmdeP2
     *
     * @return integer
     */
    public function getCmdeP2()
    {
        return $this->cmdeP2;
    }

    /**
     * Set cmdeP3
     *
     * @param integer $cmdeP3
     *
     * @return PrdReassort
     */
    public function setCmdeP3($cmdeP3)
    {
        $this->cmdeP3 = $cmdeP3;

        return $this;
    }

    /**
     * Get cmdeP3
     *
     * @return integer
     */
    public function getCmdeP3()
    {
        return $this->cmdeP3;
    }

    /**
     * Set cmdeP4
     *
     * @param integer $cmdeP4
     *
     * @return PrdReassort
     */
    public function setCmdeP4($cmdeP4)
    {
        $this->cmdeP4 = $cmdeP4;

        return $this;
    }

    /**
     * Get cmdeP4
     *
     * @return integer
     */
    public function getCmdeP4()
    {
        return $this->cmdeP4;
    }

    /**
     * Set cmdeP5
     *
     * @param integer $cmdeP5
     *
     * @return PrdReassort
     */
    public function setCmdeP5($cmdeP5)
    {
        $this->cmdeP5 = $cmdeP5;

        return $this;
    }

    /**
     * Get cmdeP5
     *
     * @return integer
     */
    public function getCmdeP5()
    {
        return $this->cmdeP5;
    }

    /**
     * Set cmdeP6
     *
     * @param integer $cmdeP6
     *
     * @return PrdReassort
     */
    public function setCmdeP6($cmdeP6)
    {
        $this->cmdeP6 = $cmdeP6;

        return $this;
    }

    /**
     * Get cmdeP6
     *
     * @return integer
     */
    public function getCmdeP6()
    {
        return $this->cmdeP6;
    }

    /**
     * Set cmdeP7
     *
     * @param integer $cmdeP7
     *
     * @return PrdReassort
     */
    public function setCmdeP7($cmdeP7)
    {
        $this->cmdeP7 = $cmdeP7;

        return $this;
    }

    /**
     * Get cmdeP7
     *
     * @return integer
     */
    public function getCmdeP7()
    {
        return $this->cmdeP7;
    }

    /**
     * Set cmdeP8
     *
     * @param integer $cmdeP8
     *
     * @return PrdReassort
     */
    public function setCmdeP8($cmdeP8)
    {
        $this->cmdeP8 = $cmdeP8;

        return $this;
    }

    /**
     * Get cmdeP8
     *
     * @return integer
     */
    public function getCmdeP8()
    {
        return $this->cmdeP8;
    }

    /**
     * Set cmdeP9
     *
     * @param integer $cmdeP9
     *
     * @return PrdReassort
     */
    public function setCmdeP9($cmdeP9)
    {
        $this->cmdeP9 = $cmdeP9;

        return $this;
    }

    /**
     * Get cmdeP9
     *
     * @return integer
     */
    public function getCmdeP9()
    {
        return $this->cmdeP9;
    }

    /**
     * Set cmdeP10
     *
     * @param integer $cmdeP10
     *
     * @return PrdReassort
     */
    public function setCmdeP10($cmdeP10)
    {
        $this->cmdeP10 = $cmdeP10;

        return $this;
    }

    /**
     * Get cmdeP10
     *
     * @return integer
     */
    public function getCmdeP10()
    {
        return $this->cmdeP10;
    }

    /**
     * Set cmdeP11
     *
     * @param integer $cmdeP11
     *
     * @return PrdReassort
     */
    public function setCmdeP11($cmdeP11)
    {
        $this->cmdeP11 = $cmdeP11;

        return $this;
    }

    /**
     * Get cmdeP11
     *
     * @return integer
     */
    public function getCmdeP11()
    {
        return $this->cmdeP11;
    }

    /**
     * Set cmdeP12
     *
     * @param integer $cmdeP12
     *
     * @return PrdReassort
     */
    public function setCmdeP12($cmdeP12)
    {
        $this->cmdeP12 = $cmdeP12;

        return $this;
    }

    /**
     * Get cmdeP12
     *
     * @return integer
     */
    public function getCmdeP12()
    {
        return $this->cmdeP12;
    }
}