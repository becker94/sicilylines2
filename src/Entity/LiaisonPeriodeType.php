<?php

namespace App\Entity;

use App\Repository\LiaisonPeriodeTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LiaisonPeriodeTypeRepository::class)]
class LiaisonPeriodeType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tarif = null;

    #[ORM\ManyToOne(inversedBy: 'liaisonPeriodeTypes')]
    private ?Periode $periode = null;

    #[ORM\ManyToOne(inversedBy: 'liaisonPeriodeTypes')]
    private ?Liaison $liaison = null;

    #[ORM\ManyToOne(inversedBy: 'liaisonPeriodeTypes')]
    private ?Type $type = null;

   
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarif(): ?string
    {
        return $this->tarif;
    }

    public function setTarif(string $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getPeriode(): ?Periode
    {
        return $this->periode;
    }

    public function setPeriode(?Periode $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLiaison(): ?Liaison
    {
        return $this->liaison;
    }

    public function setLiaison(?Liaison $liaison): self
    {
        $this->liaison = $liaison;

        return $this;
    }
}
