<?php

namespace DV\EcomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Reassort
 *
 */
class Reassort
{
    /**
     *  var prdReassort
     */
    protected $prdReassorts;

    public function __construct()
    {   
        $this->prdReassorts = new ArrayCollection();
    }
 
    /**
     * Add prdReassort
     *
     * @param \DV\EcomBundle\Entity\PrdReassort $prdReassort
     *
     * @return PrdReassort
     */
    public function addPrdReassort(\DV\EcomBundle\Entity\PrdReassort $prdReassort)
    {
        $this->prdReassort[] = $prdReassort;

        return $this;
    }

    /**
     * Remove prdReassort
     *
     * @param \DV\EcomBundle\Entity\prdReassort $prdReassort
     */
    public function removePrdReassort(\DV\EcomBundle\Entity\PrdReassort $prdReassort)
    {
        $this->prdReassort->removeElement($prdReassort);
    }

    /**
     * Get prdReassort
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrdReassort()
    {
        return $this->prdReassort;
    }
}
