<?php

namespace App\Entity;

use App\Repository\HistorisationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistorisationRepository::class)]
class Historisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private ?int $NbrUser = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateHistorisation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrUser(): ?int
    {
        return $this->NbrUser;
    }

    public function setNbrUser(int $NbrUser): static
    {
        $this->NbrUser = $NbrUser;

        return $this;
    }

    public function getDateHistorisation(): ?\DateTimeInterface
    {
        return $this->DateHistorisation;
    }

    public function setDateHistorisation(\DateTimeInterface $DateHistorisation): static
    {
        $this->DateHistorisation = $DateHistorisation;

        return $this;
    }
}
