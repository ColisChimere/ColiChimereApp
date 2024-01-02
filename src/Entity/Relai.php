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

    #[ORM\OneToMany(mappedBy: 'relai', targetEntity: User::class)]
    private Collection $utilisateurs;

    #[ORM\OneToMany(mappedBy: 'relai', targetEntity: Casier::class)]
    private Collection $casiers;

    #[ORM\OneToOne(inversedBy: 'relai', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adresse $adresse = null;

    #[ORM\OneToMany(mappedBy: 'relai', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->casiers = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    /**
     * @return Collection<int, Casier>
     */
    public function getCasiers(): Collection
    {
        return $this->casiers;
    }

    public function addCasier(Casier $casier): static
    {
        if (!$this->casiers->contains($casier)) {
            $this->casiers->add($casier);
            $casier->setRelai($this);
        }

        return $this;
    }

    public function removeCasier(Casier $casier): static
    {
        if ($this->casiers->removeElement($casier)) {
            // set the owning side to null (unless already changed)
            if ($casier->getRelai() === $this) {
                $casier->setRelai(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setRelai($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRelai() === $this) {
                $user->setRelai(null);
            }
        }

        return $this;
    }
}
