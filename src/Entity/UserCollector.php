<?php

namespace App\Entity;

use App\Repository\UserCollectorRepository;
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
}
