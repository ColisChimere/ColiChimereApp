<?php

namespace App\Entity;

use App\Repository\UserConnexionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserConnexionRepository::class)]
class UserConnexion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tokken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateUtilisation = null;

    #[ORM\ManyToOne(inversedBy: 'userConnexions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?int $lifeTime = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTokken(): ?string
    {
        return $this->tokken;
    }

    public function setTokken(string $tokken): static
    {
        $this->tokken = $tokken;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateUtilisation(): ?\DateTimeInterface
    {
        return $this->dateUtilisation;
    }

    public function setDateUtilisation(\DateTimeInterface $dateUtilisation): static
    {
        $this->dateUtilisation = $dateUtilisation;

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

    public function getLifeTime(): ?int
    {
        return $this->lifeTime;
    }

    public function setLifeTime(int $lifeTime): static
    {
        $this->lifeTime = $lifeTime;

        return $this;
    }
    public function isValid(): bool
    {
        if((new \DateTime)->getTimestamp() - $this->dateCreation->getTimestamp() > $this->lifeTime) return false;
        return true;
    }
}
