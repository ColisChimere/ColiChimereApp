<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $rue = null;

    #[ORM\Column(length: 50)]
    private ?string $numRue = null;

    #[ORM\OneToMany(mappedBy: 'adresse', targetEntity: ClientAdress::class)]
    private Collection $clientAdresses;

    #[ORM\OneToOne(mappedBy: 'adresse', cascade: ['persist', 'remove'])]
    private ?Relai $relai = null;

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ville $ville = null;

    public function __construct()
    {
        $this->clientAdresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): static
    {
        $this->rue = $rue;

        return $this;
    }

    public function getNumRue(): ?string
    {
        return $this->numRue;
    }

    public function setNumRue(string $numRue): static
    {
        $this->numRue = $numRue;

        return $this;
    }

    /**
     * @return Collection<int, ClientAdress>
     */
    public function getClientAdresses(): Collection
    {
        return $this->clientAdresses;
    }

    public function addClientAdress(ClientAdress $clientAdress): static
    {
        if (!$this->clientAdresses->contains($clientAdress)) {
            $this->clientAdresses->add($clientAdress);
            $clientAdress->setAdresse($this);
        }

        return $this;
    }

    public function removeClientAdress(ClientAdress $clientAdress): static
    {
        if ($this->clientAdresses->removeElement($clientAdress)) {
            // set the owning side to null (unless already changed)
            if ($clientAdress->getAdresse() === $this) {
                $clientAdress->setAdresse(null);
            }
        }

        return $this;
    }

    public function getRelai(): ?Relai
    {
        return $this->relai;
    }

    public function setRelai(Relai $relai): static
    {
        // set the owning side of the relation if necessary
        if ($relai->getAdresse() !== $this) {
            $relai->setAdresse($this);
        }

        $this->relai = $relai;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

}
