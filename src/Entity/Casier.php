<?php

namespace App\Entity;

use App\Repository\CasierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CasierRepository::class)]
class Casier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1)]
    private ?string $etatCA = null;

    #[ORM\ManyToOne(inversedBy: 'casier')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ModelCasier $modelCasier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtatCA(): ?string
    {
        return $this->etatCA;
    }

    public function setEtatCA(string $etatCA): static
    {
        $this->etatCA = $etatCA;

        return $this;
    }

    public function getModelCasier(): ?ModelCasier
    {
        return $this->modelCasier;
    }

    public function setModelCasier(?ModelCasier $modelCasier): static
    {
        $this->modelCasier = $modelCasier;

        return $this;
    }
}
