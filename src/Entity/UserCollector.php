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

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }



}
