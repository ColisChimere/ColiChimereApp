<?php

namespace App\Entity;

use App\Repository\ModelCasierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelCasierRepository::class)]
class ModelCasier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lidelle = null;

    #[ORM\Column]
    private ?int $largModCm = null;

    #[ORM\Column]
    private ?int $hautModCm = null;

    #[ORM\Column]
    private ?int $longModCm = null;

    #[ORM\OneToMany(mappedBy: 'modelCasier', targetEntity: Casier::class)]
    private Collection $casier;

    public function __construct()
    {
        $this->casier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLidelle(): ?string
    {
        return $this->lidelle;
    }

    public function setLidelle(string $lidelle): static
    {
        $this->lidelle = $lidelle;

        return $this;
    }

    public function getLargModCm(): ?int
    {
        return $this->largModCm;
    }

    public function setLargModCm(int $largModCm): static
    {
        $this->largModCm = $largModCm;

        return $this;
    }

    public function getHautModCm(): ?int
    {
        return $this->hautModCm;
    }

    public function setHautModCm(int $hautModCm): static
    {
        $this->hautModCm = $hautModCm;

        return $this;
    }

    public function getLongModCm(): ?int
    {
        return $this->longModCm;
    }

    public function setLongModCm(int $longModCm): static
    {
        $this->longModCm = $longModCm;

        return $this;
    }

    /**
     * @return Collection<int, Casier>
     */
    public function getCasier(): Collection
    {
        return $this->casier;
    }

    public function addCasier(Casier $casier): static
    {
        if (!$this->casier->contains($casier)) {
            $this->casier->add($casier);
            $casier->setModelCasier($this);
        }

        return $this;
    }

    public function removeCasier(Casier $casier): static
    {
        if ($this->casier->removeElement($casier)) {
            // set the owning side to null (unless already changed)
            if ($casier->getModelCasier() === $this) {
                $casier->setModelCasier(null);
            }
        }

        return $this;
    }
}
