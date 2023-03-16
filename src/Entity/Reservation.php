<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    private ?Client $client = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Traversee $traversee = null;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: ReservationType::class)]
    private Collection $reservationTypes;

    public function __construct()
    {
        $this->reservationTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getTraversee(): ?Traversee
    {
        return $this->traversee;
    }

    public function setTraversee(?Traversee $traversee): self
    {
        $this->traversee = $traversee;

        return $this;
    }

    /**
     * @return Collection<int, ReservationType>
     */
    public function getReservationTypes(): Collection
    {
        return $this->reservationTypes;
    }

    public function addReservationType(ReservationType $reservationType): self
    {
        if (!$this->reservationTypes->contains($reservationType)) {
            $this->reservationTypes->add($reservationType);
            $reservationType->setReservation($this);
        }

        return $this;
    }

    public function removeReservationType(ReservationType $reservationType): self
    {
        if ($this->reservationTypes->removeElement($reservationType)) {
            // set the owning side to null (unless already changed)
            if ($reservationType->getReservation() === $this) {
                $reservationType->setReservation(null);
            }
        }

        return $this;
    }
}
