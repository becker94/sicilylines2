<?php

namespace App\Entity;

use App\Repository\BateauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BateauRepository::class)]
class Bateau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $longueur = null;

    #[ORM\Column(length: 255)]
    private ?string $largeur = null;

    #[ORM\Column(length: 255)]
    private ?string $vitesse = null;

    #[ORM\OneToMany(mappedBy: 'bateau', targetEntity: Traversee::class)]
    private Collection $traversees;

    #[ORM\OneToMany(mappedBy: 'bateau', targetEntity: EquipementBateau::class)]
    private Collection $equipementBateaus;

    #[ORM\OneToMany(mappedBy: 'bateau', targetEntity: CategorieBateau::class)]
    private Collection $categorieBateaus;

    public function __construct()
    {
        $this->traversees = new ArrayCollection();
        $this->equipementBateaus = new ArrayCollection();
        $this->categorieBateaus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLongueur(): ?string
    {
        return $this->longueur;
    }

    public function setLongueur(string $longueur): self
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getLargeur(): ?string
    {
        return $this->largeur;
    }

    public function setLargeur(string $largeur): self
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getVitesse(): ?string
    {
        return $this->vitesse;
    }

    public function setVitesse(string $vitesse): self
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    /**
     * @return Collection<int, Traversee>
     */
    public function getTraversees(): Collection
    {
        return $this->traversees;
    }

    public function addTraversee(Traversee $traversee): self
    {
        if (!$this->traversees->contains($traversee)) {
            $this->traversees->add($traversee);
            $traversee->setBateau($this);
        }

        return $this;
    }

    public function removeTraversee(Traversee $traversee): self
    {
        if ($this->traversees->removeElement($traversee)) {
            // set the owning side to null (unless already changed)
            if ($traversee->getBateau() === $this) {
                $traversee->setBateau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EquipementBateau>
     */
    public function getEquipementBateaus(): Collection
    {
        return $this->equipementBateaus;
    }

    public function addEquipementBateau(EquipementBateau $equipementBateau): self
    {
        if (!$this->equipementBateaus->contains($equipementBateau)) {
            $this->equipementBateaus->add($equipementBateau);
            $equipementBateau->setBateau($this);
        }

        return $this;
    }

    public function removeEquipementBateau(EquipementBateau $equipementBateau): self
    {
        if ($this->equipementBateaus->removeElement($equipementBateau)) {
            // set the owning side to null (unless already changed)
            if ($equipementBateau->getBateau() === $this) {
                $equipementBateau->setBateau(null);
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
            $categorieBateau->setBateau($this);
        }

        return $this;
    }

    public function removeCategorieBateau(CategorieBateau $categorieBateau): self
    {
        if ($this->categorieBateaus->removeElement($categorieBateau)) {
            // set the owning side to null (unless already changed)
            if ($categorieBateau->getBateau() === $this) {
                $categorieBateau->setBateau(null);
            }
        }

        return $this;
    }
}
