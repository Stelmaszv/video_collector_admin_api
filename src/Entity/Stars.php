<?php

namespace App\Entity;

use App\Repository\StarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StarsRepository::class)]
class Stars
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationality = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $weight = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $height = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ethnicity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $hair_color = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_of_birth = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $place_of_birth = null;

    #[ORM\ManyToMany(targetEntity: Movies::class, mappedBy: 'Stars')]
    private Collection $movies;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'stars')]
    private Collection $Tags;

    #[ORM\ManyToOne(inversedBy: 'stars')]
    private ?Collectors $Collectors = null;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
        $this->Tags = new ArrayCollection();
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

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(?string $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getEthnicity(): ?string
    {
        return $this->ethnicity;
    }

    public function setEthnicity(?string $ethnicity): self
    {
        $this->ethnicity = $ethnicity;

        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->hair_color;
    }

    public function setHairColor(?string $hair_color): self
    {
        $this->hair_color = $hair_color;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(?\DateTimeInterface $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->place_of_birth;
    }

    public function setPlaceOfBirth(?string $place_of_birth): self
    {
        $this->place_of_birth = $place_of_birth;

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
            $movie->addStar($this);
        }

        return $this;
    }

    public function removeMovie(Movies $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            $movie->removeStar($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->Tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->Tags->contains($tag)) {
            $this->Tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->Tags->removeElement($tag);

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
