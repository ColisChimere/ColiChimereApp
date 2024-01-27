<?php

namespace App\Entity;

use App\Repository\CommandECRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandECRepository::class)]
class CommandEC
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_heure = null;

    #[ORM\ManyToOne(inversedBy: 'commandECs')]
    private ?Commande $commande = null;

    #[ORM\ManyToOne(inversedBy: 'commandECs')]
    private ?EtatCommande $etatCommande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->date_heure;
    }

    public function setDateHeure(\DateTimeInterface $date_heure): static
    {
        $this->date_heure = $date_heure;

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

    public function getEtatCommande(): ?EtatCommande
    {
        return $this->etatCommande;
    }

    public function setEtatCommande(?EtatCommande $etatCommande): static
    {
        $this->etatCommande = $etatCommande;

        return $this;
    }
}
