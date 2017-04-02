<?php

namespace AD\AdBundle\Entity;

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
     * @param \AD\AdBundle\Entity\PrdReassort $prdReassort
     *
     * @return PrdReassort
     */
    public function addPrdReassort(\AD\AdBundle\Entity\PrdReassort $prdReassort)
    {
        $this->prdReassort[] = $prdReassort;

        return $this;
    }

    /**
     * Remove prdReassort
     *
     * @param \AD\AdBundle\Entity\prdReassort $prdReassort
     */
    public function removePrdReassort(\AD\AdBundle\Entity\PrdReassort $prdReassort)
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
