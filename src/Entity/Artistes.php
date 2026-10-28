<?php

namespace App\Entity;

use App\Repository\ArtistesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistesRepository::class)]
class Artistes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudonyme = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_reel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationalité = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudonyme(): ?string
    {
        return $this->pseudonyme;
    }

    public function setPseudonyme(string $pseudonyme): static
    {
        $this->pseudonyme = $pseudonyme;

        return $this;
    }

    public function getNomReel(): ?string
    {
        return $this->nom_reel;
    }

    public function setNomReel(string $nom_reel): static
    {
        $this->nom_reel = $nom_reel;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getNationalité(): ?string
    {
        return $this->nationalité;
    }

    public function setNationalité(?string $nationalité): static
    {
        $this->nationalité = $nationalité;

        return $this;
    }
}
