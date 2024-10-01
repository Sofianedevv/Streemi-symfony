<?php

namespace App\Entity;

use App\Repository\SeasonsRepository;
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
}
