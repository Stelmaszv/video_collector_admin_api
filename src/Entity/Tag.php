<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Producent::class, mappedBy: 'Tags')]
    private Collection $producents;

    #[ORM\ManyToMany(targetEntity: Series::class, mappedBy: 'Tag')]
    private Collection $series;

    #[ORM\ManyToMany(targetEntity: Movies::class, mappedBy: 'Tags')]
    private Collection $movies;

    #[ORM\ManyToMany(targetEntity: Stars::class, mappedBy: 'Tags')]
    private Collection $stars;

    public function __construct()
    {
        $this->producents = new ArrayCollection();
        $this->series = new ArrayCollection();
        $this->movies = new ArrayCollection();
        $this->stars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $producent->addTag($this);
        }

        return $this;
    }

    public function removeProducent(Producent $producent): self
    {
        if ($this->producents->removeElement($producent)) {
            $producent->removeTag($this);
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
            $series->addTag($this);
        }

        return $this;
    }

    public function removeSeries(Series $series): self
    {
        if ($this->series->removeElement($series)) {
            $series->removeTag($this);
        }

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
            $movie->addTag($this);
        }

        return $this;
    }

    public function removeMovie(Movies $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            $movie->removeTag($this);
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
            $star->addTag($this);
        }

        return $this;
    }

    public function removeStar(Stars $star): self
    {
        if ($this->stars->removeElement($star)) {
            $star->removeTag($this);
        }

        return $this;
    }
}
