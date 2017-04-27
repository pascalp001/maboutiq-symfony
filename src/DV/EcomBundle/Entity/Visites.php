<?php

namespace DV\EcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visites
 *
 * @ORM\Table("visites")
 * @ORM\Entity(repositoryClass="DV\EcomBundle\Repository\VisitesRepository")
 */
class Visites
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
     * @var integer
     *
     * @ORM\Column(name="semaine", type="integer")
     */
    private $semaine;

    /**
     * @var integer
     *
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrevisites", type="integer")
     */
    private $nbrevisites;


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
     * Set semaine
     *
     * @param integer $semaine
     *
     * @return Visites
     */
    public function setSemaine($semaine)
    {
        $this->semaine = $semaine;

        return $this;
    }

    /**
     * Get semaine
     *
     * @return integer
     */
    public function getSemaine()
    {
        return $this->semaine;
    }

    /**
     * Set annee
     *
     * @param integer $annee
     *
     * @return Visites
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set nbrevisites
     *
     * @param integer $nbrevisites
     *
     * @return Visites
     */
    public function setNbrevisites($nbrevisites)
    {
        $this->nbrevisites = $nbrevisites;

        return $this;
    }

    /**
     * Get nbrevisites
     *
     * @return integer
     */
    public function getNbrevisites()
    {
        return $this->nbrevisites;
    }
}
