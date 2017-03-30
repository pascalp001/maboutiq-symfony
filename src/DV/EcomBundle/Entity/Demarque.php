<?php
namespace DV\EcomBundle\Entity;

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
     * @param \DV\EcomBundle\Entity\Demarque $Demarque
     *
     * @return Demarques
     */
    public function addPrdDemarque(\DV\EcomBundle\Entity\PrdDemarque $prdDemarque)
    {
        $this->prdDemarque[] = $prdDemarque;

        return $this;
    }

    /**
     * Remove prdDemarque
     *
     * @param \DV\EcomBundle\Entity\prdDemarque $prdDemarque
     */
    public function removeDemarque(\DV\EcomBundle\Entity\PrdDemarque $prdDemarque)
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
