<?php

namespace App\Entity;

use App\Repository\EtatCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatCommandeRepository::class)]
class EtatCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'etatCommande', targetEntity: CommandEC::class)]
    private Collection $commandECs;

    public function __construct()
    {
        $this->commandECs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

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
            $commandEC->setEtatCommande($this);
        }

        return $this;
    }

    public function removeCommandEC(CommandEC $commandEC): static
    {
        if ($this->commandECs->removeElement($commandEC)) {
            // set the owning side to null (unless already changed)
            if ($commandEC->getEtatCommande() === $this) {
                $commandEC->setEtatCommande(null);
            }
        }

        return $this;
    }
}
