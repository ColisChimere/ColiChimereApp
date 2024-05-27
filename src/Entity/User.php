<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $pseudo = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $numTel = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserConnexion::class)]
    private Collection $userConnexions;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ClientAdress::class)]
    private Collection $clientAdresses;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Preference::class)]
    private Collection $preferences;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Relai $relai = null;

    #[ORM\Column(length: 2)]
    private ?string $typeUser = "U";

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'userCible', targetEntity: Commande::class)]
    private Collection $commandes;

    #[ORM\OneToMany(mappedBy: 'operateur', targetEntity: Livraision::class)]
    private Collection $livraisions;

    public function __construct()
    {
        $this->userConnexions = new ArrayCollection();
        $this->clientAdresses = new ArrayCollection();
        $this->preferences = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->livraisions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
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
            $userConnexion->setUser($this);
        }

        return $this;
    }

    public function removeUserConnexion(UserConnexion $userConnexion): static
    {
        if ($this->userConnexions->removeElement($userConnexion)) {
            // set the owning side to null (unless already changed)
            if ($userConnexion->getUser() === $this) {
                $userConnexion->setUser(null);
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
            $clientAdress->setUser($this);
        }

        return $this;
    }

    public function removeClientAdress(ClientAdress $clientAdress): static
    {
        if ($this->clientAdresses->removeElement($clientAdress)) {
            // set the owning side to null (unless already changed)
            if ($clientAdress->getUser() === $this) {
                $clientAdress->setUser(null);
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
            $preference->setUser($this);
        }

        return $this;
    }

    public function removePreference(Preference $preference): static
    {
        if ($this->preferences->removeElement($preference)) {
            // set the owning side to null (unless already changed)
            if ($preference->getUser() === $this) {
                $preference->setUser(null);
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

    public function getTypeUser(): ?string
    {
        return $this->typeUser;
    }

    public function setTypeUser(string $typeUser): static
    {
        $this->typeUser = $typeUser;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setUserCible($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getUserCible() === $this) {
                $commande->setUserCible(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Livraision>
     */
    public function getLivraisions(): Collection
    {
        return $this->livraisions;
    }

    public function addLivraision(Livraision $livraision): static
    {
        if (!$this->livraisions->contains($livraision)) {
            $this->livraisions->add($livraision);
            $livraision->setOperateur($this);
        }

        return $this;
    }

    public function removeLivraision(Livraision $livraision): static
    {
        if ($this->livraisions->removeElement($livraision)) {
            // set the owning side to null (unless already changed)
            if ($livraision->getOperateur() === $this) {
                $livraision->setOperateur(null);
            }
        }

        return $this;
    }
     public function addRole(string $role): void
    {
        $this->roles[] = $role;
    }

    public function removeRole(string $role): void
    {
        $key = array_search($role, $this->roles, true);
        if ($key !== false) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles); // réindexe les rôles
        }
    }
    public function CreateToken(string $type, int $lifeTime): string
    {
        $tokken = null;
        while ($tokken == null) {
            $tokken = $this->email + bin2hex(openssl_random_pseudo_bytes(16));
            foreach($this->userConnexions as $usrConn)
            {
                if($usrConn->getTokken() == $tokken) $tokken = null;
            }
        }
        $tokken = $this->email . $type . bin2hex(openssl_random_pseudo_bytes(16));
        $usrConn = new UserConnexion();
        $usrConn->setTokken($tokken);
        $usrConn->setLifeTime($lifeTime);
        $usrConn->setUser($this);
        $usrConn->setDateCreation(new \DateTime());
        $this->addUserConnexion($usrConn);
        return $tokken;
    }
}

