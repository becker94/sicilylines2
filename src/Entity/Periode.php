<?php

namespace App\Entity;

use App\Repository\PeriodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeriodeRepository::class)]
class Periode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\OneToMany(mappedBy: 'periode', targetEntity: LiaisonPeriodeType::class)]
    private Collection $liaisonPeriodeTypes;

   
    public function __construct()
    {
        $this->tarifer = new ArrayCollection();
        $this->liaisonPeriodeTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection<int, Tarifer>
     */
    public function getTarifer(): Collection
    {
        return $this->tarifer;
    }

    public function addTarifer(Tarifer $tarifer): self
    {
        if (!$this->tarifer->contains($tarifer)) {
            $this->tarifer->add($tarifer);
            $tarifer->setPeriode($this);
        }

        return $this;
    }

    public function removeTarifer(Tarifer $tarifer): self
    {
        if ($this->tarifer->removeElement($tarifer)) {
            // set the owning side to null (unless already changed)
            if ($tarifer->getPeriode() === $this) {
                $tarifer->setPeriode(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LiaisonPeriodeType>
     */
    public function getLiaisonPeriodeTypes(): Collection
    {
        return $this->liaisonPeriodeTypes;
    }

    public function addLiaisonPeriodeType(LiaisonPeriodeType $liaisonPeriodeType): self
    {
        if (!$this->liaisonPeriodeTypes->contains($liaisonPeriodeType)) {
            $this->liaisonPeriodeTypes->add($liaisonPeriodeType);
            $liaisonPeriodeType->setPeriode($this);
        }

        return $this;
    }

    public function removeLiaisonPeriodeType(LiaisonPeriodeType $liaisonPeriodeType): self
    {
        if ($this->liaisonPeriodeTypes->removeElement($liaisonPeriodeType)) {
            // set the owning side to null (unless already changed)
            if ($liaisonPeriodeType->getPeriode() === $this) {
                $liaisonPeriodeType->setPeriode(null);
            }
        }

        return $this;
    }
}
