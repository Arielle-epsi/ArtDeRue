<?php

namespace App\Entity;

use App\Repository\OeuvresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OeuvresRepository::class)]
class Oeuvres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?\DateTime $date_creation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => false])]
    private ?bool $est_detruite = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lieux $lieu = null;

    #[ORM\ManyToOne(targetEntity: self::class)]
    private ?self $oeuvre_recouverte = null;

    /**
     * @var Collection<int, Artistes>
     */
    #[ORM\ManyToMany(targetEntity: Artistes::class)]
    #[ORM\JoinTable(name: 'oeuvres_artistes')]
    #[ORM\JoinColumn(name: 'oeuvres_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'artistes_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    private Collection $artistes;

    /**
     * @var Collection<int, Techniques>
     */
    #[ORM\ManyToMany(targetEntity: Techniques::class)]
    #[ORM\JoinTable(name: 'oeuvres_techniques')]
    #[ORM\JoinColumn(name: 'oeuvres_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'techniques_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    private Collection $techniques;

    public function __construct()
    {
        $this->artistes = new ArrayCollection();
        $this->techniques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTime $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isEstDetruite(): ?bool
    {
        return $this->est_detruite;
    }

    public function setEstDetruite(bool $est_detruite): static
    {
        $this->est_detruite = $est_detruite;

        return $this;
    }

    public function getLieu(): ?Lieux
    {
        return $this->lieu;
    }

    public function setLieu(?Lieux $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getOeuvreRecouverte(): ?self
    {
        return $this->oeuvre_recouverte;
    }

    public function setOeuvreRecouverte(?self $oeuvre_recouverte): static
    {
        $this->oeuvre_recouverte = $oeuvre_recouverte;

        return $this;
    }

    /**
     * @return Collection<int, Artistes>
     */
    public function getArtistes(): Collection
    {
        return $this->artistes;
    }

    public function addArtiste(Artistes $artiste): static
    {
        if (!$this->artistes->contains($artiste)) {
            $this->artistes->add($artiste);
        }

        return $this;
    }

    public function removeArtiste(Artistes $artiste): static
    {
        $this->artistes->removeElement($artiste);

        return $this;
    }

    /**
     * @return Collection<int, Techniques>
     */
    public function getTechniques(): Collection
    {
        return $this->techniques;
    }

    public function addTechnique(Techniques $technique): static
    {
        if (!$this->techniques->contains($technique)) {
            $this->techniques->add($technique);
        }

        return $this;
    }

    public function removeTechnique(Techniques $technique): static
    {
        $this->techniques->removeElement($technique);

        return $this;
    }
}