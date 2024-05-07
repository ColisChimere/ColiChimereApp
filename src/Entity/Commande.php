<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $masse = null;

    #[ORM\Column]
    private ?int $largeCol = null;

    #[ORM\Column]
    private ?int $longCol = null;

    #[ORM\Column]
    private ?int $hauteurCol = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Relai $relaiDepart = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?User $userCible = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandEC::class)]
    private Collection $commandECs;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Occupe::class)]
    private Collection $historiqueOccupation;

    #[ORM\OneToOne(mappedBy: 'commande', cascade: ['persist', 'remove'])]
    private ?Livraision $livraision = null;

    public function __construct()
    {
        $this->commandECs = new ArrayCollection();
        $this->historiqueOccupation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMasse(): ?int
    {
        return $this->masse;
    }

    public function setMasse(int $masse): static
    {
        $this->masse = $masse;

        return $this;
    }

    public function getLargeCol(): ?int
    {
        return $this->largeCol;
    }

    public function setLargeCol(int $largeCol): static
    {
        $this->largeColl = $largeCol;

        return $this;
    }

    public function getLongCol(): ?int
    {
        return $this->longCol;
    }

    public function setLongCol(int $longCol): static
    {
        $this->longColl = $longCol;

        return $this;
    }

    public function getHauteurCol(): ?int
    {
        return $this->hauteurCol;
    }

    public function setHauteurCol(int $hauteurCol): static
    {
        $this->hauteurCol = $hauteurCol;

        return $this;
    }

    public function getRelaiDepart(): ?Relai
    {
        return $this->relaiDepart;
    }

    public function setRelaiDepart(?Relai $relaiDepart): static
    {
        $this->relaiDepart = $relaiDepart;

        return $this;
    }

    public function getUserCible(): ?User
    {
        return $this->userCible;
    }

    public function setUserCible(?User $userCible): static
    {
        $this->userCible = $userCible;

        return $this;
    }

    /**
     * @return Collection<int, CommandEC>
     */
    public function getCommandECs(): Collection
    {
        return $this->commandECs;
    }

    public function addCommandEC(CommandEC $commandEC): static
    {
        if (!$this->commandECs->contains($commandEC)) {
            $this->commandECs->add($commandEC);
            $commandEC->setCommande($this);
        }

        return $this;
    }

    public function removeCommandEC(CommandEC $commandEC): static
    {
        if ($this->commandECs->removeElement($commandEC)) {
            // set the owning side to null (unless already changed)
            if ($commandEC->getCommande() === $this) {
                $commandEC->setCommande(null);
            }
        }

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
            $historiqueOccupation->setCommande($this);
        }

        return $this;
    }

    public function removeHistoriqueOccupation(Occupe $historiqueOccupation): static
    {
        if ($this->historiqueOccupation->removeElement($historiqueOccupation)) {
            // set the owning side to null (unless already changed)
            if ($historiqueOccupation->getCommande() === $this) {
                $historiqueOccupation->setCommande(null);
            }
        }

        return $this;
    }

    public function getLivraision(): ?Livraision
    {
        return $this->livraision;
    }

    public function setLivraision(Livraision $livraision): static
    {
        // set the owning side of the relation if necessary
        if ($livraision->getCommande() !== $this) {
            $livraision->setCommande($this);
        }

        $this->livraision = $livraision;

        return $this;
    }
}
