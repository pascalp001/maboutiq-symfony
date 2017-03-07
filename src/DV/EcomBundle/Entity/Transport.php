<?php

namespace DV\EcomBundle\Entity;


/**
 * Transport
 *
 */
class Transport
{

    /**
     * @var string
     * livraison.nom
     */
    private $nom;

    /**
     * @var string
     * livraison.prenom
     */
    private $prenom;

    /**
     * @var string
     * livraison.adresse
     */
    private $adresse;

    /**
     * @var string
     * livraison.complement
     */
    private $complement;

    /**
     * @var string
     *livraison.cp
     */
    private $cp;

    /**
     * @var string
     * livraison.ville
     */
    private $ville;

    /**
     * @var string
     * 
     */
    private $modport;  


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Transport
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Transport
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }


    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Transport
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return Transport
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Transport
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }


    /**
     * Set complement
     *
     * @param string $complement
     *
     * @return Transport
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set modport
     *
     * @param string $modport
     *
     * @return Transport
     */
    public function setModport($modport)
    {
        $this->modport = $modport;

        return $this;
    }

    /**
     * Get modport
     *
     * @return modport
     */
    public function getModport()
    {
        return $this->modport;
    }
}