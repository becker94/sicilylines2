<?php

namespace App\Entity;

use App\Repository\PortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortRepository::class)]
class Port
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'port_depart', targetEntity: Liaison::class)]
    private Collection $liaisons;

   

    public function __construct()
    {
        $this->liaisons = new ArrayCollection();
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

    /**
     * @return Collection<int, Liaison>
     */
    public function getLiaisons(): Collection
    {
        return $this->liaisons;
    }

    public function addLiaison(Liaison $liaison): self
    {
        if (!$this->liaisons->contains($liaison)) {
            $this->liaisons->add($liaison);
            $liaison->setPort($this);
        }

        return $this;
    }

    public function removeLiaison(Liaison $liaison): self
    {
        if ($this->liaisons->removeElement($liaison)) {
            // set the owning side to null (unless already changed)
            if ($liaison->getPort() === $this) {
                $liaison->setPort(null);
            }
        }

        return $this;
    }
}
