<?php

namespace App\Entity;

use App\Repository\UserCollectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserCollectorRepository::class)]
class UserCollector
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'userCollector', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?admin $User = null;

    #[ORM\Column]
    private ?bool $can_edit = null;

    #[ORM\Column]
    private ?bool $can_delete = null;

    #[ORM\ManyToMany(targetEntity: Collectors::class, mappedBy: 'ManyToMany')]
    private Collection $yes;

    #[ORM\ManyToMany(targetEntity: Collectors::class, mappedBy: 'UserController')]
    private Collection $collectors;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
        $this->collectors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?admin
    {
        return $this->User;
    }

    public function setUser(admin $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function isCanEdit(): ?bool
    {
        return $this->can_edit;
    }

    public function setCanEdit(bool $can_edit): self
    {
        $this->can_edit = $can_edit;

        return $this;
    }

    public function isCanDelete(): ?bool
    {
        return $this->can_delete;
    }

    public function setCanDelete(bool $can_delete): self
    {
        $this->can_delete = $can_delete;

        return $this;
    }

    /**
     * @return Collection<int, Collectors>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Collectors $ye): self
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->addManyToMany($this);
        }

        return $this;
    }

    public function removeYe(Collectors $ye): self
    {
        if ($this->yes->removeElement($ye)) {
            $ye->removeManyToMany($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Collectors>
     */
    public function getCollectors(): Collection
    {
        return $this->collectors;
    }

    public function addCollector(Collectors $collector): self
    {
        if (!$this->collectors->contains($collector)) {
            $this->collectors->add($collector);
            $collector->addUserController($this);
        }

        return $this;
    }

    public function removeCollector(Collectors $collector): self
    {
        if ($this->collectors->removeElement($collector)) {
            $collector->removeUserController($this);
        }

        return $this;
    }
}
