<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 * 
 */
class Document
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
        private $document;

        /**
         * @ORM\Column(type="string", length=255)
         */
        private $titre;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Page", mappedBy="document")
     */
    private $pages;


        /**
         * @return UploadedFile
         */
        public function getDocument()
        {
            return $this->document;
        }
    
        /**
         * @param \Symfony\Component\HttpFoundation\File\UploadedFile $document
         */
        public function setDocument($document)
        {
            $this->document = $document;
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
    

