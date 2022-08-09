<?php
namespace App\Entity;
use App\Repository\CollectorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectorsRepository::class)]
class Collectors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: UserCollector::class, inversedBy: 'collectors')]
    private Collection $UserController;

    #[ORM\Column(length: 200)]
    private ?string $Name = null;

    public function __construct()
    {
        $this->UserController = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, UserCollector>
     */
    public function getUserController(): Collection
    {
        return $this->UserController;
    }

    public function addUserController(UserCollector $userController): self
    {
        if (!$this->UserController->contains($userController)) {
            $this->UserController->add($userController);
        }

        return $this;
    }

    public function removeUserController(UserCollector $userController): self
    {
        $this->UserController->removeElement($userController);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

}
