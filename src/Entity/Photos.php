<?php

namespace App\Entity;

use App\Repository\PhotosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotosRepository::class)]
class Photos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $date_prise_vue = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_fichier = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $etat_oeuvre = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Oeuvres $oeuvre = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Benevoles $benevole = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePriseVue(): ?\DateTime
    {
        return $this->date_prise_vue;
    }

    public function setDatePriseVue(\DateTime $date_prise_vue): static
    {
        $this->date_prise_vue = $date_prise_vue;

        return $this;
    }

    public function getNomFichier(): ?string
    {
        return $this->nom_fichier;
    }

    public function setNomFichier(string $nom_fichier): static
    {
        $this->nom_fichier = $nom_fichier;

        return $this;
    }

    public function getEtatOeuvre(): ?string
    {
        return $this->etat_oeuvre;
    }

    public function setEtatOeuvre(?string $etat_oeuvre): static
    {
        $this->etat_oeuvre = $etat_oeuvre;

        return $this;
    }

    public function getOeuvre(): ?Oeuvres
    {
        return $this->oeuvre;
    }

    public function setOeuvre(?Oeuvres $oeuvre): static
    {
        $this->oeuvre = $oeuvre;

        return $this;
    }

    public function getBenevole(): ?Benevoles
    {
        return $this->benevole;
    }

    public function setBenevole(?Benevoles $benevole): static
    {
        $this->benevole = $benevole;

        return $this;
    }
}
