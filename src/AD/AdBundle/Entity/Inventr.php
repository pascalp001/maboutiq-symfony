<?php
namespace AD\AdBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Inventr
 *
 */
class Inventr
{
    /**
     *  var prdInventrs
     */
    protected $prdInventrs;

    private $validprov;

    public function __construct()
    {   
        $this->prdInventrs = new ArrayCollection();
    }
 
    /**
     * Add prdDemarque
     *
     * @param \AD\AdBundle\Entity\Demarque $Demarque
     *
     * @return Demarques
     */
    public function addprdInventr(\AD\AdBundle\Entity\prdInventr $prdInventr)
    {
        $this->prdInventr[] = $prdInventr;

        return $this;
    }

    /**
     * Remove prdInventr
     *
     * @param \AD\AdBundle\Entity\prdInventr $prdInventr
     */
    public function removeInventr(\AD\AdBundle\Entity\prdInventr $prdInventr)
    {
        $this->prdInventr->removeElement($prdInventr);
    }

    /**
     * Get prdInventr
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getprdInventr()
    {
        return $this->prdInventr;
    }

    public function setValidprov($validprov)
    {
        $this->validprov = $validprov;
        
        return $this;
    }

    public function getValidprov()
    {
        return $this->validprov;
    }

}
