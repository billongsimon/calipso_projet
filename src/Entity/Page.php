<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $jourAt;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="pages")
     */
    private $categorie;

    /**
     * @var UploadedFile
      * @ORM\ManyToOne(targetEntity="App\Entity\Document", inversedBy="pages")
     */
    private $document;

    /**
     * @var Page
     * @ORM\ManyToOne(targetEntity="App\Entity\Page", inversedBy="enfants")
     */
    private $page_parent;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Page", mappedBy="page_parent")
     */
    private $enfants;

    public function __construct()
    {
        $this->enfants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getJourAt(): ?\DateTimeInterface
    {
        return $this->jourAt;
    }

    public function setJourAt(\DateTimeInterface $jourAt): self
    {
        $this->jourAt = $jourAt;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
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
    public function setFichier($fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * @return Page
     */
    public function getPageParent(): ?Page
    {
        return $this->page_parent;
    }

    /**
     * @param Page $page_parent
     */
    public function setPageParent($page_parent): self
    {
        $this->page_parent = $page_parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getEnfants(): Collection
    {
        return $this->enfants;
    }

    public function addEnfant(self $enfant): self
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
        }

        return $this;
    }

    public function removeEnfant(self $enfant): self
    {
        if ($this->enfants->contains($enfant)) {
            $this->enfants->removeElement($enfant);
        }

        return $this;
    }
}
