<?php

namespace App\Entity;

use App\Repository\CasierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CasierRepository::class)]
class Casier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1)]
    private ?string $etatCA = null;

    #[ORM\ManyToOne(inversedBy: 'casier')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ModelCasier $modelCasier = null;

    #[ORM\Column(length: 50)]
    private ?string $numero = null;

    #[ORM\ManyToOne(inversedBy: 'casiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Relai $relai = null;

    #[ORM\OneToMany(mappedBy: 'casier', targetEntity: Occupe::class)]
    private Collection $historiqueOccupation;

    public function __construct()
    {
        $this->historiqueOccupation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtatCA(): ?string
    {
        return $this->etatCA;
    }

    public function setEtatCA(string $etatCA): static
    {
        $this->etatCA = $etatCA;

        return $this;
    }

    public function getModelCasier(): ?ModelCasier
    {
        return $this->modelCasier;
    }

    public function setModelCasier(?ModelCasier $modelCasier): static
    {
        $this->modelCasier = $modelCasier;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRelai(): ?Relai
    {
        return $this->relai;
    }

    public function setRelai(?Relai $relai): static
    {
        $this->relai = $relai;

        return $this;
    }

    /**
     * @return Collection<int, Occupe>
     */
    public function getHistoriqueOccupation(): Collection
    {
        return $this->historiqueOccupation;
    }

    public function addHistoriqueOccupation(Occupe $historiqueOccupation): static
    {
        if (!$this->historiqueOccupation->contains($historiqueOccupation)) {
            $this->historiqueOccupation->add($historiqueOccupation);
            $historiqueOccupation->setCasier($this);
        }

        return $this;
    }

    public function removeHistoriqueOccupation(Occupe $historiqueOccupation): static
    {
        if ($this->historiqueOccupation->removeElement($historiqueOccupation)) {
            // set the owning side to null (unless already changed)
            if ($historiqueOccupation->getCasier() === $this) {
                $historiqueOccupation->setCasier(null);
            }
        }

        return $this;
    }
}
