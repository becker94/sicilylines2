<?php

namespace App\Entity;

use App\Repository\SecteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecteurRepository::class)]
class Secteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'secteur', targetEntity: Liaison::class)]
    private Collection $liaison;

    public function __construct()
    {
        $this->liaison = new ArrayCollection();
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
     * @return Collection<int, Liaison>
     */
    public function getLiaison(): Collection
    {
        return $this->liaison;
    }

    public function addLiaison(Liaison $liaison): self
    {
        if (!$this->liaison->contains($liaison)) {
            $this->liaison->add($liaison);
            $liaison->setSecteur($this);
        }

        return $this;
    }

    public function removeLiaison(Liaison $liaison): self
    {
        if ($this->liaison->removeElement($liaison)) {
            // set the owning side to null (unless already changed)
            if ($liaison->getSecteur() === $this) {
                $liaison->setSecteur(null);
            }
        }

        return $this;
    }
    
}
