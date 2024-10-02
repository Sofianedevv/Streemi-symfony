<?php

namespace App\Entity;

use App\Repository\SeasonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonsRepository::class)]
class Seasons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $seasonsNumber = null;

    #[ORM\ManyToOne(inversedBy: 'seasons')]
    private ?Serie $serie = null;

    /**
     * @var Collection<int, Episodes>
     */
    #[ORM\OneToMany(targetEntity: Episodes::class, mappedBy: 'season')]
    private Collection $episodes;

    public function __construct()
    {
        $this->episodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeasonsNumber(): ?int
    {
        return $this->seasonsNumber;
    }

    public function setSeasonsNumber(?int $seasonsNumber): static
    {
        $this->seasonsNumber = $seasonsNumber;

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * @return Collection<int, Episodes>
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episodes $episode): static
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes->add($episode);
            $episode->setSeason($this);
        }

        return $this;
    }

    public function removeEpisode(Episodes $episode): static
    {
        if ($this->episodes->removeElement($episode)) {
            // set the owning side to null (unless already changed)
            if ($episode->getSeason() === $this) {
                $episode->setSeason(null);
            }
        }

        return $this;
    }
}
