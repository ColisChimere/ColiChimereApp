<?php

namespace App\Entity;

use App\Repository\RelaiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelaiRepository::class)]
class Relai
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomRelai = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Adresse $adresse = null;

    #[ORM\OneToMany(mappedBy: 'relai', targetEntity: User::class)]
    private Collection $utilisateurs;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRelai(): ?string
    {
        return $this->nomRelai;
    }

    public function setNomRelai(string $nomRelai): static
    {
        $this->nomRelai = $nomRelai;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(User $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->setRelai($this);
        }

        return $this;
    }

    public function removeUtilisateur(User $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getRelai() === $this) {
                $utilisateur->setRelai(null);
            }
        }

        return $this;
    }
}
