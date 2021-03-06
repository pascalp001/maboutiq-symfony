<?php

namespace DV\EcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarif
 *
 * @ORM\Table("tarif")
 * @ORM\Entity(repositoryClass="DV\EcomBundle\Repository\TarifRepository")
 */
class Tarif
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
     * @var string
     *
    * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
    * @ORM\Column(name="org", type="string", length=100)
     */
    private $org;

    /**
     * @var string
     *
    * @ORM\Column(name="img", type="string", length=255)
     */
    private $img;

    /**
     * @var integer
     *
     * @ORM\Column(name="typPays", type="integer")
     */
    private $typPays;

    /**
     * @var integer
     *
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxdim", type="integer")
     */
    private $maxdim;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="maxepais", type="integer")
     */
    private $maxepais;

    /**
     * @var float
     *
    * @ORM\Column(name="t0", type="float")
     */
    private $t0;

    /**
     * @var integer
     *
     * @ORM\Column(name="p0", type="integer")
     */
    private $p0;

    /**
     * @var float
     *
     * @ORM\Column(name="t1", type="float")
     */
    private $t1;

    /**
     * @var integer
     *
     * @ORM\Column(name="p1", type="integer")
     */
    private $p1;

    /**
     * @var float
     *
     * @ORM\Column(name="t2", type="float")
     */
    private $t2;

    /**
     * @var integer
     *
     * @ORM\Column(name="p2", type="integer")
     */
    private $p2;

    /**
     * @var float
     *
     * @ORM\Column(name="t3", type="float")
     */
    private $t3;

    /**
     * @var integer
     *
     * @ORM\Column(name="p3", type="integer")
     */
    private $p3;

    /**
     * @var float
     *
     * @ORM\Column(name="t4", type="float")
     */
    private $t4;

    /**
     * @var integer
     *
     * @ORM\Column(name="p4", type="integer")
     */
    private $p4;

    /**
     * @var float
     *
     * @ORM\Column(name="t5", type="float")
     */
    private $t5;

    /**
     * @var integer
     *
     * @ORM\Column(name="p5", type="integer")
     */
    private $p5;

    /**
     * @var float
     *
     * @ORM\Column(name="t6", type="float")
     */
    private $t6;

    /**
     * @var integer
     *
     * @ORM\Column(name="p6", type="integer")
     */
    private $p6;

    /**
     * @var float
     *
     * @ORM\Column(name="t7", type="float")
     */
    private $t7;

    /**
     * @var integer
     *
     * @ORM\Column(name="p7", type="integer")
     */
    private $p7;

    /**
     * @var float
     *
     * @ORM\Column(name="t8", type="float")
     */
    private $t8;

    /**
     * @var integer
     *
     * @ORM\Column(name="p8", type="integer")
     */
    private $p8;

    /**
     * @var float
     *
     * @ORM\Column(name="t9", type="float")
     */
    private $t9;

    /**
     * @var integer
     *
     * @ORM\Column(name="p9", type="integer")
     */
    private $p9;

    /**
     * @var float
     *
     * @ORM\Column(name="t10", type="float")
     */
    private $t10;


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
     * @return Tarif
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
     * Set annee
     *
     * @param integer $annee
     *
     * @return Tarif
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
     * Set maxdim
     *
     * @param integer $maxdim
     *
     * @return Tarif
     */
    public function setMaxdim($maxdim)
    {
        $this->maxdim = $maxdim;

        return $this;
    }

    /**
     * Get maxdim
     *
     * @return integer
     */
    public function getMaxdim()
    {
        return $this->maxdim;
    }

    /**
     * Set t0
     *
     * @param float $t0
     *
     * @return Tarif
     */
    public function setT0($t0)
    {
        $this->t0 = $t0;

        return $this;
    }

    /**
     * Get t0
     *
     * @return float
     */
    public function getT0()
    {
        return $this->t0;
    }

    /**
     * Set p0
     *
     * @param integer $p0
     *
     * @return Tarif
     */
    public function setP0($p0)
    {
        $this->p0 = $p0;

        return $this;
    }

    /**
     * Get p0
     *
     * @return integer
     */
    public function getP0()
    {
        return $this->p0;
    }

    /**
     * Set t1
     *
     * @param float $t1
     *
     * @return Tarif
     */
    public function setT1($t1)
    {
        $this->t1 = $t1;

        return $this;
    }

    /**
     * Get t1
     *
     * @return float
     */
    public function getT1()
    {
        return $this->t1;
    }

    /**
     * Set p1
     *
     * @param integer $p1
     *
     * @return Tarif
     */
    public function setP1($p1)
    {
        $this->p1 = $p1;

        return $this;
    }

    /**
     * Get p1
     *
     * @return integer
     */
    public function getP1()
    {
        return $this->p1;
    }

    /**
     * Set t2
     *
     * @param float $t2
     *
     * @return Tarif
     */
    public function setT2($t2)
    {
        $this->t2 = $t2;

        return $this;
    }

    /**
     * Get t2
     *
     * @return float
     */
    public function getT2()
    {
        return $this->t2;
    }

    /**
     * Set p2
     *
     * @param integer $p2
     *
     * @return Tarif
     */
    public function setP2($p2)
    {
        $this->p2 = $p2;

        return $this;
    }

    /**
     * Get p2
     *
     * @return integer
     */
    public function getP2()
    {
        return $this->p2;
    }

    /**
     * Set t3
     *
     * @param float $t3
     *
     * @return Tarif
     */
    public function setT3($t3)
    {
        $this->t3 = $t3;

        return $this;
    }

    /**
     * Get t3
     *
     * @return float
     */
    public function getT3()
    {
        return $this->t3;
    }

    /**
     * Set p3
     *
     * @param integer $p3
     *
     * @return Tarif
     */
    public function setP3($p3)
    {
        $this->p3 = $p3;

        return $this;
    }

    /**
     * Get p3
     *
     * @return integer
     */
    public function getP3()
    {
        return $this->p3;
    }

    /**
     * Set t4
     *
     * @param float $t4
     *
     * @return Tarif
     */
    public function setT4($t4)
    {
        $this->t4 = $t4;

        return $this;
    }

    /**
     * Get t4
     *
     * @return float
     */
    public function getT4()
    {
        return $this->t4;
    }

    /**
     * Set p4
     *
     * @param integer $p4
     *
     * @return Tarif
     */
    public function setP4($p4)
    {
        $this->p4 = $p4;

        return $this;
    }

    /**
     * Get p4
     *
     * @return integer
     */
    public function getP4()
    {
        return $this->p4;
    }

    /**
     * Set t5
     *
     * @param float $t5
     *
     * @return Tarif
     */
    public function setT5($t5)
    {
        $this->t5 = $t5;

        return $this;
    }

    /**
     * Get t5
     *
     * @return float
     */
    public function getT5()
    {
        return $this->t5;
    }

    /**
     * Set p5
     *
     * @param integer $p5
     *
     * @return Tarif
     */
    public function setP5($p5)
    {
        $this->p5 = $p5;

        return $this;
    }

    /**
     * Get p5
     *
     * @return integer
     */
    public function getP5()
    {
        return $this->p5;
    }

    /**
     * Set t6
     *
     * @param float $t6
     *
     * @return Tarif
     */
    public function setT6($t6)
    {
        $this->t6 = $t6;

        return $this;
    }

    /**
     * Get t6
     *
     * @return float
     */
    public function getT6()
    {
        return $this->t6;
    }

    /**
     * Set p6
     *
     * @param integer $p6
     *
     * @return Tarif
     */
    public function setP6($p6)
    {
        $this->p6 = $p6;

        return $this;
    }

    /**
     * Get p6
     *
     * @return integer
     */
    public function getP6()
    {
        return $this->p6;
    }

    /**
     * Set t7
     *
     * @param float $t7
     *
     * @return Tarif
     */
    public function setT7($t7)
    {
        $this->t7 = $t7;

        return $this;
    }

    /**
     * Get t7
     *
     * @return float
     */
    public function getT7()
    {
        return $this->t7;
    }

    /**
     * Set p7
     *
     * @param integer $p7
     *
     * @return Tarif
     */
    public function setP7($p7)
    {
        $this->p7 = $p7;

        return $this;
    }

    /**
     * Get p7
     *
     * @return integer
     */
    public function getP7()
    {
        return $this->p7;
    }

    /**
     * Set t8
     *
     * @param float $t8
     *
     * @return Tarif
     */
    public function setT8($t8)
    {
        $this->t8 = $t8;

        return $this;
    }

    /**
     * Get t8
     *
     * @return float
     */
    public function getT8()
    {
        return $this->t8;
    }

    /**
     * Set p8
     *
     * @param integer $p8
     *
     * @return Tarif
     */
    public function setP8($p8)
    {
        $this->p8 = $p8;

        return $this;
    }

    /**
     * Get p8
     *
     * @return integer
     */
    public function getP8()
    {
        return $this->p8;
    }

    /**
     * Set t9
     *
     * @param float $t9
     *
     * @return Tarif
     */
    public function setT9($t9)
    {
        $this->t9 = $t9;

        return $this;
    }

    /**
     * Get t9
     *
     * @return float
     */
    public function getT9()
    {
        return $this->t9;
    }

    /**
     * Set p9
     *
     * @param integer $p9
     *
     * @return Tarif
     */
    public function setP9($p9)
    {
        $this->p9 = $p9;

        return $this;
    }

    /**
     * Get p9
     *
     * @return integer
     */
    public function getP9()
    {
        return $this->p9;
    }

    /**
     * Set t10
     *
     * @param float $t10
     *
     * @return Tarif
     */
    public function setT10($t10)
    {
        $this->t10 = $t10;

        return $this;
    }

    /**
     * Get t10
     *
     * @return float
     */
    public function getT10()
    {
        return $this->t10;
    }

    /**
     * Set org
     *
     * @param string $org
     *
     * @return Tarif
     */
    public function setOrg($org)
    {
        $this->org = $org;

        return $this;
    }

    /**
     * Get org
     *
     * @return string
     */
    public function getOrg()
    {
        return $this->org;
    }

    /**
     * Set typPays
     *
     * @param integer $typPays
     *
     * @return Tarif
     */
    public function setTypPays($typPays)
    {
        $this->typPays = $typPays;

        return $this;
    }

    /**
     * Get typPays
     *
     * @return integer
     */
    public function getTypPays()
    {
        return $this->typPays;
    }

    /**
     * Set maxepais
     *
     * @param integer $maxepais
     *
     * @return Tarif
     */
    public function setMaxepais($maxepais)
    {
        $this->maxepais = $maxepais;

        return $this;
    }

    /**
     * Get maxepais
     *
     * @return integer
     */
    public function getMaxepais()
    {
        return $this->maxepais;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return Tarif
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }
}
