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

    #[ORM\Column(length: 200)]
    private ?string $Name = null;

    #[ORM\OneToMany(mappedBy: 'Collector', targetEntity: UserCollector::class)]
    private Collection $userCollectors;

    public function __construct()
    {
        $this->userCollectors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, UserCollector>
     */
    public function getUserCollectors(): Collection
    {
        return $this->userCollectors;
    }

    public function addUserCollector(UserCollector $userCollector): self
    {
        if (!$this->userCollectors->contains($userCollector)) {
            $this->userCollectors->add($userCollector);
            $userCollector->setCollector($this);
        }

        return $this;
    }

    public function removeUserCollector(UserCollector $userCollector): self
    {
        if ($this->userCollectors->removeElement($userCollector)) {
            // set the owning side to null (unless already changed)
            if ($userCollector->getCollector() === $this) {
                $userCollector->setCollector(null);
            }
        }

        return $this;
    }

}
