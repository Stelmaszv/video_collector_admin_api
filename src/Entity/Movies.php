<?php

namespace App\Entity;

use App\Repository\MoviesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoviesRepository::class)]
class Movies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $full_name = null;

    #[ORM\Column(length: 255)]
    private ?string $dir = null;

    #[ORM\Column(length: 255)]
    private ?string $src = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $show_name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_relesed = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poster = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $back_cover = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    private ?Series $Serie = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    private ?Producent $Producent = null;

    #[ORM\ManyToMany(targetEntity: Stars::class, inversedBy: 'movies')]
    private Collection $Stars;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $custom_cover = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $custom_cover2 = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'movies')]
    private Collection $Tags;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    private ?Collectors $Colector = null;

    public function __construct()
    {
        $this->Stars = new ArrayCollection();
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

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

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

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {   
        $this->src = $src;
        return $this;
    }

    public function getShowName(): ?string
    {
        return $this->show_name;
    }

    public function setShowName(?string $show_name): self
    {
        $this->show_name = $show_name;

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

    public function getDateRelesed(): ?\DateTimeInterface
    {
        return $this->date_relesed;
    }

    public function setDateRelesed(?\DateTimeInterface $date_relesed): self
    {
        $this->date_relesed=$date_relesed;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        
        if ($this->cover == 'getsezon:0'){
            $this->cover='';
        }else{
            $this->cover = $cover;
        }
        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getBackCover(): ?string
    {
        return $this->back_cover;
    }

    public function setBackCover(string $back_cover): self
    {
        $this->back_cover = $back_cover;

        return $this;
    }

    public function getSerie(): ?Series
    {
        return $this->Serie;
    }

    public function setSerie(?Series $Serie): self
    {
        $this->Serie = $Serie;

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
     * @return Collection<int, Stars>
     */
    public function getStars(): Collection
    {
        return $this->Stars;
    }

    public function addStar(Stars $star): self
    {
        if (!$this->Stars->contains($star)) {
            $this->Stars->add($star);
        }

        return $this;
    }

    public function removeStar(Stars $star): self
    {
        $this->Stars->removeElement($star);

        return $this;
    }

    public function getCustomCover(): ?string
    {
        return $this->custom_cover;
    }

    public function setCustomCover(?string $custom_cover): self
    {
        $this->custom_cover = $custom_cover;

        return $this;
    }

    public function getCustomCover2(): ?string
    {
        return $this->custom_cover2;
    }

    public function setCustomCover2(?string $custom_cover2): self
    {
        $this->custom_cover2 = $custom_cover2;

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

    public function getColector(): ?Collectors
    {
        return $this->Colector;
    }

    public function setColector(?Collectors $Colector): self
    {
        $this->Colector = $Colector;

        return $this;
    }
}
