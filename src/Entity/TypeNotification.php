<?php

namespace App\Entity;

use App\Repository\TypeNotificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeNotificationRepository::class)]
class TypeNotification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleNotification = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleNotification(): ?string
    {
        return $this->libelleNotification;
    }

    public function setLibelleNotification(string $libelleNotification): static
    {
        $this->libelleNotification = $libelleNotification;

        return $this;
    }
}
