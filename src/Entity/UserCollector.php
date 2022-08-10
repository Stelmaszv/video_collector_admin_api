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

    #[ORM\Column]
    private ?bool $can_edit = null;

    #[ORM\Column]
    private ?bool $can_delete = null;

    #[ORM\ManyToOne(inversedBy: 'userCollectors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Collectors $Collector = null;

    #[ORM\ManyToOne(inversedBy: 'userCollectors')]
    private ?Admin $Admin = null;

    public function __construct()
    {
       
    }

    public function getCanEdit(){
        return $this->can_edit;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollector(): ?Collectors
    {
        return $this->Collector;
    }

    public function setCollector(?Collectors $Collector): self
    {
        $this->Collector = $Collector;

        return $this;
    }

    public function getAdmin(): ?Admin
    {
        return $this->Admin;
    }

    public function setAdmin(?Admin $Admin): self
    {
        $this->Admin = $Admin;

        return $this;
    }


}
