<?php

namespace App\Entity;

use App\Repository\CategorieBateauRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieBateauRepository::class)]
class CategorieBateau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbMAx = null;

    #[ORM\ManyToOne(inversedBy: 'categorieBateaus')]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'categorieBateaus')]
    private ?Bateau $bateau = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbMAx(): ?int
    {
        return $this->nbMAx;
    }

    public function setNbMAx(int $nbMAx): self
    {
        $this->nbMAx = $nbMAx;

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

    public function getBateau(): ?Bateau
    {
        return $this->bateau;
    }

    public function setBateau(?Bateau $bateau): self
    {
        $this->bateau = $bateau;

        return $this;
    }
}
