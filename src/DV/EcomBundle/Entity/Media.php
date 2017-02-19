<?php

namespace DV\EcomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\validator\Constraints as Assert;

/**
 * Media
 *
 * @ORM\Table("media")
 * @ORM\Entity(repositoryClass="DV\EcomBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Media
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    //On rajoute 2 champs $name et $path, 
    //et un attribut $file utilisé pour le champ de saisie 'file' du formulaire qui transmet ensuite au path :

    /**
    * @ORM\Column(name="name", type="string", length=255)
    * @Assert\NotBlank
    */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    public $file;

    /**
    * @var \DateTime
    *
    * @ORM\Column(name="updated_at", type="datetime", nullable=true)
    */
    public $updateAt;

    /**
    * @ORM\PostLoad()
    */   
    public function postLoad()
    {
        $this->updateAt = new \DateTime();
    }

    public function getUploadRootDir()
    {
        //dossier où on doit uploader l'image :
        return __dir__.'/../../../../web/uploads';
    }

    public function getAbsolutePath()
    {
        // retourne web/uploads / nom_du_fichier . extension :
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path; 
    }

    public function getAssetPath()
    {
        return 'uploads/'.$this->path; 
    }

    //On place ici les callbacks : un pour agir après avoir persisté, l'autre pour agir avant update

    /**
    * @ORM\Prepersist()
    * @ORM\Preupdate()
    */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath(); //contenu des fichiers temporaires quand on upload l'image
        $this->oldFile = $this->getPath() ; //va servir à modifier une image et supprimer l'ancienne image
        $this->updateAt = new \DateTime();

        if(null !== $this->file)
            $this->path = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension(); //un id aléatoire suivi de l'extension du fichier
    }

    /**
    * @ORM\PostPersist()
    * @ORM\PostUpdate()
    */
     public function upload()
     {
       if(null !== $this->file)
       {
         $this->file->move($this->getUploadRootDir(), $this->path); // on déplace le fichier
         unset($this->file); //on supprime le fichier temporaire
         if($this->oldFile != null) unlink($this->tempFile); //Si il y avait déjà une image précédente, on la supprime
       }   
     }

    /**
    * @ORM\PreRemove()
    */ 
    public function preRemoveUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
    }   

    /**
    * @ORM\PostRemove()
    */ 
    public function removeUpload()
    {
        if(file_exists($this->tempFile)) unlink($this->tempFile);//on va supprimer l'image quand on va supprimer l'entité
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

    public function getPath()
    {
        return $this->path;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
}
