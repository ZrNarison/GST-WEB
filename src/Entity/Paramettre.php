<?php

namespace App\Entity;

use App\Repository\ParamettreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParamettreRepository::class)]
class Paramettre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Societe;

    #[ORM\Column(type: 'string', length: 255)]
    private $Representant;

    #[ORM\Column(type: 'string', length: 255)]
    private $Localisation;

    #[ORM\Column(type: 'string', length: 255)]
    private $Adresse;

    #[ORM\Column(type: 'string', length: 255)]
    private $Responsable;

    #[ORM\Column(type: 'string', length: 255)]
    private $Entete;

    #[ORM\Column(type: 'float')]
    private $Courant;

    #[ORM\Column(type: 'float')]
    private $SJirama;

    #[ORM\Column(type: 'float')]
    private $SSP;

    #[ORM\Column(type: 'float')]
    private $Redevence;

    #[ORM\Column(type: 'float')]
    private $PrimeFixe;

    #[ORM\Column(type: 'float')]
    private $Redv;

    #[ORM\Column(type: 'float')]
    private $Consommation;

    #[ORM\Column(type: 'float')]
    private $Tva;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSociete(): ?string
    {
        return $this->Societe;
    }

    public function setSociete(string $Societe): self
    {
        $this->Societe = $Societe;

        return $this;
    }

    public function getRepresentant(): ?string
    {
        return $this->Representant;
    }

    public function setRepresentant(string $Representant): self
    {
        $this->Representant = $Representant;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->Localisation;
    }

    public function setLocalisation(string $Localisation): self
    {
        $this->Localisation = $Localisation;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getResponsable(): ?string
    {
        return $this->Responsable;
    }

    public function setResponsable(string $Responsable): self
    {
        $this->Responsable = $Responsable;

        return $this;
    }

    public function getEntete(): ?string
    {
        return $this->Entete;
    }

    public function setEntete(string $Entete): self
    {
        $this->Entete = $Entete;

        return $this;
    }

    public function getCourant(): ?float
    {
        return $this->Courant;
    }

    public function setCourant(float $Courant): self
    {
        $this->Courant = $Courant;

        return $this;
    }

    public function getSJirama(): ?float
    {
        return $this->SJirama;
    }

    public function setSJirama(float $SJirama): self
    {
        $this->SJirama = $SJirama;

        return $this;
    }

    public function getSSP(): ?float
    {
        return $this->SSP;
    }

    public function setSSP(float $SSP): self
    {
        $this->SSP = $SSP;

        return $this;
    }

    public function getRedevence(): ?float
    {
        return $this->Redevence;
    }

    public function setRedevence(float $Redevence): self
    {
        $this->Redevence = $Redevence;

        return $this;
    }

    public function getPrimeFixe(): ?float
    {
        return $this->PrimeFixe;
    }

    public function setPrimeFixe(float $PrimeFixe): self
    {
        $this->PrimeFixe = $PrimeFixe;

        return $this;
    }

    public function getRedv(): ?float
    {
        return $this->Redv;
    }

    public function setRedv(float $Redv): self
    {
        $this->Redv = $Redv;

        return $this;
    }

    public function getConsommation(): ?float
    {
        return $this->Consommation;
    }

    public function setConsommation(float $Consommation): self
    {
        $this->Consommation = $Consommation;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->Tva;
    }

    public function setTva(float $Tva): self
    {
        $this->Tva = $Tva;

        return $this;
    }
}
