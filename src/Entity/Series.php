<?php

namespace App\Entity;

use App\Repository\SeriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeriesRepository::class)]
class Series
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $dir = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $show_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $years = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column]
    private ?int $number_of_sezons = null;

    #[ORM\OneToMany(mappedBy: 'Serie', targetEntity: Movies::class)]
    private Collection $movies;

    #[ORM\ManyToOne(inversedBy: 'series')]
    private ?Producent $Producent = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'series')]
    private Collection $Tag;

    #[ORM\ManyToOne(inversedBy: 'series')]
    private ?Collectors $Collectors = null;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
        $this->Tag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    
    public function getDetelName(): ?string
    {
        if (empty($this->show_name)){
            return $this->name;
        }
        return $this->show_name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDir(): ?string
    {
        return $this->dir;
    }

    public function setDir(string $dir): self
    {
        $this->dir = $dir;

        return $this;
    }

    public function getShowName(): ?string
    {
        return $this->show_name;
    }

    public function setShowName(string $show_name): self
    {
        $this->show_name = $show_name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getYears(): ?string
    {
        return $this->years;
    }

    public function setYears(string $years): self
    {
        $this->years = $years;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getNumberOfSezons(): ?int
    {
        return $this->number_of_sezons;
    }

    public function setNumberOfSezons(int $number_of_sezons): self
    {
        $this->number_of_sezons = $number_of_sezons;

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
            $movie->setSerie($this);
        }

        return $this;
    }

    public function removeMovie(Movies $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            // set the owning side to null (unless already changed)
            if ($movie->getSerie() === $this) {
                $movie->setSerie(null);
            }
        }

        return $this;
    }

    public function getProducent(): ?Producent
    {
        return $this->Producent;
    }

    public function setProducent(?Producent $Producent): self
    {
        $this->Producent = $Producent;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->Tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->Tag->contains($tag)) {
            $this->Tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->Tag->removeElement($tag);

        return $this;
    }

    public function getCollectors(): ?Collectors
    {
        return $this->Collectors;
    }

    public function setCollectors(?Collectors $Collectors): self
    {
        $this->Collectors = $Collectors;

        return $this;
    }

}
