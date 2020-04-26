<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FichierRepository")
 */
class Fichier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
        
        /**
         * @var UploadedFile
         */
        private $fichier;

        /**
         * @ORM\Column(type="string", length=255)
         */
        private $titre;
    
        
        /**
         * @return UploadedFile
         */
        public function getFichier()
        {
            return $this->fichier;
        }
    
        /**
         * @param \Symfony\Component\HttpFoundation\File\UploadedFile $fichier
         */
        public function setFichier($fichier)
        {
            $this->fichier = $fichier;
        }

        public function getTitre(): ?string
        {
            return $this->titre;
        }

        public function setTitre(string $titre): self
        {
            $this->titre = $titre;

            return $this;
        }
    }
    

