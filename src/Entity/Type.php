<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'types')]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: ReservationType::class)]
    private Collection $ReservationTypes;

  

    public function __construct()
    {
        $this->ReservationTypes = new ArrayCollection();
        
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
     * @return Collection<int, ReservationType>
     */
    public function getReservationTypes(): Collection
    {
        return $this->ReservationTypes;
    }

    public function addReservationType(ReservationType $ReservationType): self
    {
        if (!$this->ReservationTypes->contains($ReservationType)) {
            $this->ReservationTypes->add($ReservationType);
            $ReservationType->setType($this);
        }

        return $this;
    }

    public function removeReservationType(ReservationType $ReservationType): self
    {
        if ($this->ReservationTypes->removeElement($ReservationType)) {
            // set the owning side to null (unless already changed)
            if ($ReservationType->getType() === $this) {
                $ReservationType->setType(null);
            }
        }

        return $this;
    }

    
    }
