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

    #[ORM\Column(length: 200)]
    private ?string $CODE = null;

    #[ORM\OneToMany(mappedBy: 'Colector', targetEntity: Movies::class)]
    private Collection $movies;

    #[ORM\OneToMany(mappedBy: 'Collector', targetEntity: Producent::class)]
    private Collection $producents;

    #[ORM\OneToMany(mappedBy: 'Collectors', targetEntity: Series::class)]
    private Collection $series;

    #[ORM\OneToMany(mappedBy: 'Collectors', targetEntity: Stars::class)]
    private Collection $stars;

    public function __construct()
    {
        $this->userCollectors = new ArrayCollection();
        $this->movies = new ArrayCollection();
        $this->producents = new ArrayCollection();
        $this->series = new ArrayCollection();
        $this->stars = new ArrayCollection();
        
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

    public function getCODE(): ?string
    {
        return $this->CODE;
    }

    public function setCODE(string $CODE): self
    {
        $this->CODE = $CODE;

        return $this;
    }

    /**
     * @return Collection<int, Movies>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movies $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies->add($movie);
            $movie->setColector($this);
        }

        return $this;
    }

    public function removeMovie(Movies $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            // set the owning side to null (unless already changed)
            if ($movie->getColector() === $this) {
                $movie->setColector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Producent>
     */
    public function getProducents(): Collection
    {
        return $this->producents;
    }

    public function addProducent(Producent $producent): self
    {
        if (!$this->producents->contains($producent)) {
            $this->producents->add($producent);
            $producent->setCollector($this);
        }

        return $this;
    }

    public function removeProducent(Producent $producent): self
    {
        if ($this->producents->removeElement($producent)) {
            // set the owning side to null (unless already changed)
            if ($producent->getCollector() === $this) {
                $producent->setCollector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Series>
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSeries(Series $series): self
    {
        if (!$this->series->contains($series)) {
            $this->series->add($series);
            $series->setCollectors($this);
        }

        return $this;
    }

    public function removeSeries(Series $series): self
    {
        if ($this->series->removeElement($series)) {
            // set the owning side to null (unless already changed)
            if ($series->getCollectors() === $this) {
                $series->setCollectors(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Stars>
     */
    public function getStars(): Collection
    {
        return $this->stars;
    }

    public function addStar(Stars $star): self
    {
        if (!$this->stars->contains($star)) {
            $this->stars->add($star);
            $star->setCollectors($this);
        }

        return $this;
    }

    public function removeStar(Stars $star): self
    {
        if ($this->stars->removeElement($star)) {
            // set the owning side to null (unless already changed)
            if ($star->getCollectors() === $this) {
                $star->setCollectors(null);
            }
        }

        return $this;
    }



}
