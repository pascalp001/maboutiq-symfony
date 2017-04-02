<?php
namespace AD\AdBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Demarque
 *
 */
class Demarque
{
    /**
     *  var prdDemarques
     */
    protected $prdDemarques;

    public function __construct()
    {   
        $this->prdDemarques = new ArrayCollection();
    }
 
    /**
     * Add prdDemarque
     *
     * @param \AD\AdBundle\Entity\Demarque $Demarque
     *
     * @return Demarques
     */
    public function addPrdDemarque(\AD\AdBundle\Entity\PrdDemarque $prdDemarque)
    {
        $this->prdDemarque[] = $prdDemarque;

        return $this;
    }

    /**
     * Remove prdDemarque
     *
     * @param \AD\AdBundle\Entity\prdDemarque $prdDemarque
     */
    public function removeDemarque(\AD\AdBundle\Entity\PrdDemarque $prdDemarque)
    {
        $this->prdDemarque->removeElement($prdDemarque);
    }

    /**
     * Get prdDemarque
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrdDemarque()
    {
        return $this->prdDemarque;
    }
}
