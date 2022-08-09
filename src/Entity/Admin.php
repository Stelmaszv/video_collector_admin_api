<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToOne(mappedBy: 'User', cascade: ['persist', 'remove'])]
    private ?UserCollector $userCollector = null;

    #[ORM\OneToMany(mappedBy: 'admin', targetEntity: UserCollector::class, orphanRemoval: true)]
    private Collection $Can_edit_items;

    public function __construct()
    {
        $this->Can_edit_items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserCollector(): ?UserCollector
    {
        return $this->userCollector;
    }

    public function setUserCollector(UserCollector $userCollector): self
    {
        // set the owning side of the relation if necessary
        if ($userCollector->getUser() !== $this) {
            $userCollector->setUser($this);
        }

        $this->userCollector = $userCollector;

        return $this;
    }

    /**
     * @return Collection<int, UserCollector>
     */
    public function getCanEditItems(): Collection
    {
        return $this->Can_edit_items;
    }

    public function addCanEditItem(UserCollector $canEditItem): self
    {
        if (!$this->Can_edit_items->contains($canEditItem)) {
            $this->Can_edit_items->add($canEditItem);
            $canEditItem->setAdmin($this);
        }

        return $this;
    }

    public function removeCanEditItem(UserCollector $canEditItem): self
    {
        if ($this->Can_edit_items->removeElement($canEditItem)) {
            // set the owning side to null (unless already changed)
            if ($canEditItem->getAdmin() === $this) {
                $canEditItem->setAdmin(null);
            }
        }

        return $this;
    }
}
