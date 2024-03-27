<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenoms = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau_scolaire = null;

    #[ORM\Column(length: 255)]
    private ?string $module_choisit = null;

    #[ORM\Column(length: 255)]
    private ?string $motif_inscription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_created = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(string $prenoms): static
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getNiveauScolaire(): ?string
    {
        return $this->niveau_scolaire;
    }

    public function setNiveauScolaire(string $niveau_scolaire): static
    {
        $this->niveau_scolaire = $niveau_scolaire;

        return $this;
    }

    public function getModuleChoisit(): ?string
    {
        return $this->module_choisit;
    }

    public function setModuleChoisit(string $module_choisit): static
    {
        $this->module_choisit = $module_choisit;

        return $this;
    }

    public function getMotifInscription(): ?string
    {
        return $this->motif_inscription;
    }

    public function setMotifInscription(string $motif_inscription): static
    {
        $this->motif_inscription = $motif_inscription;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    public function setDateCreated(\DateTimeInterface $date_created): static
    {
        $this->date_created = $date_created;

        return $this;
    }
}
