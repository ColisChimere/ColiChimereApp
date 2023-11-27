<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numTel = null;

    #[ORM\Column(length: 1)]
    private ?string $typeUser = null;

    #[ORM\OneToOne(mappedBy: 'utilisateur', cascade: ['persist', 'remove'])]
    private ?UserLogin $userLogin = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: UserConnexion::class)]
    private Collection $userConnexions;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Preference::class)]
    private Collection $preferences;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: ClientAdress::class)]
    private Collection $clientAdresses;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?Relai $relai = null;

    public function __construct()
    {
        $this->userConnexions = new ArrayCollection();
        $this->preferences = new ArrayCollection();
        $this->clientAdresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(?string $numTel): static
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getTypeUser(): ?string
    {
        return $this->typeUser;
    }

    public function setTypeUser(string $typeUser): static
    {
        $this->typeUser = $typeUser;

        return $this;
    }

    public function getUserLogin(): ?UserLogin
    {
        return $this->userLogin;
    }

    public function setUserLogin(UserLogin $userLogin): static
    {
        // set the owning side of the relation if necessary
        if ($userLogin->getUtilisateur() !== $this) {
            $userLogin->setUtilisateur($this);
        }

        $this->userLogin = $userLogin;

        return $this;
    }

    /**
     * @return Collection<int, UserConnexion>
     */
    public function getUserConnexions(): Collection
    {
        return $this->userConnexions;
    }

    public function addUserConnexion(UserConnexion $userConnexion): static
    {
        if (!$this->userConnexions->contains($userConnexion)) {
            $this->userConnexions->add($userConnexion);
            $userConnexion->setUtilisateur($this);
        }

        return $this;
    }

    public function removeUserConnexion(UserConnexion $userConnexion): static
    {
        if ($this->userConnexions->removeElement($userConnexion)) {
            // set the owning side to null (unless already changed)
            if ($userConnexion->getUtilisateur() === $this) {
                $userConnexion->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Preference>
     */
    public function getPreferences(): Collection
    {
        return $this->preferences;
    }

    public function addPreference(Preference $preference): static
    {
        if (!$this->preferences->contains($preference)) {
            $this->preferences->add($preference);
            $preference->setUtilisateur($this);
        }

        return $this;
    }

    public function removePreference(Preference $preference): static
    {
        if ($this->preferences->removeElement($preference)) {
            // set the owning side to null (unless already changed)
            if ($preference->getUtilisateur() === $this) {
                $preference->setUtilisateur(null);
            }
        }

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
            $clientAdress->setUtilisateur($this);
        }

        return $this;
    }

    public function removeClientAdress(ClientAdress $clientAdress): static
    {
        if ($this->clientAdresses->removeElement($clientAdress)) {
            // set the owning side to null (unless already changed)
            if ($clientAdress->getUtilisateur() === $this) {
                $clientAdress->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getRelai(): ?Relai
    {
        return $this->relai;
    }

    public function setRelai(?Relai $relai): static
    {
        $this->relai = $relai;

        return $this;
    }
}
