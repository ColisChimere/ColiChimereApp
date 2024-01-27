<?php

namespace App\Entity;

use App\Repository\OccupeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OccupeRepository::class)]
class Occupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $arriver = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $sorti = null;

    #[ORM\ManyToOne(inversedBy: 'historiqueOccupation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    #[ORM\ManyToOne(inversedBy: 'historiqueOccupation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Casier $casier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArriver(): ?\DateTimeInterface
    {
        return $this->arriver;
    }

    public function setArriver(\DateTimeInterface $arriver): static
    {
        $this->arriver = $arriver;

        return $this;
    }

    public function getSorti(): ?\DateTimeInterface
    {
        return $this->sorti;
    }

    public function setSorti(?\DateTimeInterface $sorti): static
    {
        $this->sorti = $sorti;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }

    public function getCasier(): ?Casier
    {
        return $this->casier;
    }

    public function setCasier(?Casier $casier): static
    {
        $this->casier = $casier;

        return $this;
    }
}
