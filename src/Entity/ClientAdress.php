<?php

namespace App\Entity;

use App\Repository\ClientAdressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientAdressRepository::class)]
class ClientAdress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1)]
    private ?string $typeAdress = null;

    #[ORM\ManyToOne(inversedBy: 'clientAdresses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'clientAdresses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adresse $adresse = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeAdress(): ?string
    {
        return $this->typeAdress;
    }

    public function setTypeAdress(string $typeAdress): static
    {
        $this->typeAdress = $typeAdress;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
