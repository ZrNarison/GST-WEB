<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Fname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Lname;

    #[ORM\Column(type: 'date')]
    private $DateNaissance;

    #[ORM\Column(type: 'string', length: 255)]
    private $LieuNaissance;

    #[ORM\Column(type: 'string', length: 255)]
    private $PieceJustificatif;

    #[ORM\Column(type: 'date')]
    private $DateDelivrance;

    #[ORM\Column(type: 'string', length: 255)]
    private $LieuDelivrance;

    #[ORM\Column(type: 'string', length: 255)]
    private $FilliationPere;

    #[ORM\Column(type: 'string', length: 255)]
    private $FilliationMere;

    #[ORM\Column(type: 'string', length: 255)]
    private $Profession;

    #[ORM\Column(type: 'date')]
    private $DateVente;

    #[ORM\Column(type: 'float', nullable: true)]
    private $Caution;

    #[ORM\Column(type: 'string', length: 255)]
    private $Adresse;

    #[ORM\Column(type: 'float', nullable: true)]
    private $Telephone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $SituationFamille;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Epous;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Enfants;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $NIF;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $STAT;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $RCS;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $CompteBanque;

    #[ORM\Column(type: 'string', length: 255)]
    private $Activite;

    #[ORM\Column(type: 'string', length: 255)]
    private $RoleActivite;

    #[ORM\Column(type: 'float')]
    private $NombreResponsable;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $MaterielUtiliser;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $DureeMateriel;

    #[ORM\Column(type: 'string', length: 255)]
    private $Slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFname(): ?string
    {
        return $this->Fname;
    }

    public function setFname(string $Fname): self
    {
        $this->Fname = $Fname;

        return $this;
    }

    public function getLname(): ?string
    {
        return $this->Lname;
    }

    public function setLname(?string $Lname): self
    {
        $this->Lname = $Lname;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->DateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $DateNaissance): self
    {
        $this->DateNaissance = $DateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->LieuNaissance;
    }

    public function setLieuNaissance(string $LieuNaissance): self
    {
        $this->LieuNaissance = $LieuNaissance;

        return $this;
    }

    public function getPieceJustificatif(): ?string
    {
        return $this->PieceJustificatif;
    }

    public function setPieceJustificatif(string $PieceJustificatif): self
    {
        $this->PieceJustificatif = $PieceJustificatif;

        return $this;
    }

    public function getDateDelivrance(): ?\DateTimeInterface
    {
        return $this->DateDelivrance;
    }

    public function setDateDelivrance(\DateTimeInterface $DateDelivrance): self
    {
        $this->DateDelivrance = $DateDelivrance;

        return $this;
    }

    public function getLieuDelivrance(): ?string
    {
        return $this->LieuDelivrance;
    }

    public function setLieuDelivrance(string $LieuDelivrance): self
    {
        $this->LieuDelivrance = $LieuDelivrance;

        return $this;
    }

    public function getFilliationPere(): ?string
    {
        return $this->FilliationPere;
    }

    public function setFilliationPere(string $FilliationPere): self
    {
        $this->FilliationPere = $FilliationPere;

        return $this;
    }

    public function getFilliationMere(): ?string
    {
        return $this->FilliationMere;
    }

    public function setFilliationMere(string $FilliationMere): self
    {
        $this->FilliationMere = $FilliationMere;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->Profession;
    }

    public function setProfession(string $Profession): self
    {
        $this->Profession = $Profession;

        return $this;
    }

    public function getDateVente(): ?\DateTimeInterface
    {
        return $this->DateVente;
    }

    public function setDateVente(\DateTimeInterface $DateVente): self
    {
        $this->DateVente = $DateVente;

        return $this;
    }

    public function getCaution(): ?float
    {
        return $this->Caution;
    }

    public function setCaution(?float $Caution): self
    {
        $this->Caution = $Caution;

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

    public function getTelephone(): ?float
    {
        return $this->Telephone;
    }

    public function setTelephone(?float $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getSituationFamille(): ?string
    {
        return $this->SituationFamille;
    }

    public function setSituationFamille(?string $SituationFamille): self
    {
        $this->SituationFamille = $SituationFamille;

        return $this;
    }

    public function getEpous(): ?string
    {
        return $this->Epous;
    }

    public function setEpous(?string $Epous): self
    {
        $this->Epous = $Epous;

        return $this;
    }

    public function getEnfants(): ?string
    {
        return $this->Enfants;
    }

    public function setEnfants(?string $Enfants): self
    {
        $this->Enfants = $Enfants;

        return $this;
    }

    public function getNIF(): ?string
    {
        return $this->NIF;
    }

    public function setNIF(?string $NIF): self
    {
        $this->NIF = $NIF;

        return $this;
    }

    public function getSTAT(): ?string
    {
        return $this->STAT;
    }

    public function setSTAT(?string $STAT): self
    {
        $this->STAT = $STAT;

        return $this;
    }

    public function getRCS(): ?string
    {
        return $this->RCS;
    }

    public function setRCS(?string $RCS): self
    {
        $this->RCS = $RCS;

        return $this;
    }

    public function getCompteBanque(): ?string
    {
        return $this->CompteBanque;
    }

    public function setCompteBanque(?string $CompteBanque): self
    {
        $this->CompteBanque = $CompteBanque;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->Activite;
    }

    public function setActivite(string $Activite): self
    {
        $this->Activite = $Activite;

        return $this;
    }

    public function getRoleActivite(): ?string
    {
        return $this->RoleActivite;
    }

    public function setRoleActivite(string $RoleActivite): self
    {
        $this->RoleActivite = $RoleActivite;

        return $this;
    }

    public function getNombreResponsable(): ?float
    {
        return $this->NombreResponsable;
    }

    public function setNombreResponsable(float $NombreResponsable): self
    {
        $this->NombreResponsable = $NombreResponsable;

        return $this;
    }

    public function getMaterielUtiliser(): ?string
    {
        return $this->MaterielUtiliser;
    }

    public function setMaterielUtiliser(?string $MaterielUtiliser): self
    {
        $this->MaterielUtiliser = $MaterielUtiliser;

        return $this;
    }

    public function getDureeMateriel(): ?string
    {
        return $this->DureeMateriel;
    }

    public function setDureeMateriel(?string $DureeMateriel): self
    {
        $this->DureeMateriel = $DureeMateriel;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->Slug;
    }

    public function setSlug(string $Slug): self
    {
        $this->Slug = $Slug;

        return $this;
    }
}
