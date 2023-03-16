<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Type::class)]
    private Collection $types;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: CategorieBateau::class)]
    private Collection $categorieBateaus;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->categorieBateaus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->setCategorie($this);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getCategorie() === $this) {
                $type->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CategorieBateau>
     */
    public function getCategorieBateaus(): Collection
    {
        return $this->categorieBateaus;
    }

    public function addCategorieBateau(CategorieBateau $categorieBateau): self
    {
        if (!$this->categorieBateaus->contains($categorieBateau)) {
            $this->categorieBateaus->add($categorieBateau);
            $categorieBateau->setCategorie($this);
        }

        return $this;
    }

    public function removeCategorieBateau(CategorieBateau $categorieBateau): self
    {
        if ($this->categorieBateaus->removeElement($categorieBateau)) {
            // set the owning side to null (unless already changed)
            if ($categorieBateau->getCategorie() === $this) {
                $categorieBateau->setCategorie(null);
            }
        }

        return $this;
    }
}
