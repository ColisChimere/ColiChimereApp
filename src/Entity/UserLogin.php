<?php

namespace App\Entity;

use App\Repository\UserLoginRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserLoginRepository::class)]
class UserLogin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $identifian = null;

    #[ORM\Column(length: 255)]
    private ?string $motDePasse = null;

    #[ORM\OneToOne(inversedBy: 'userLogin', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifian(): ?string
    {
        return $this->identifian;
    }

    public function setIdentifian(string $identifian): static
    {
        $this->identifian = $identifian;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): static
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(User $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
