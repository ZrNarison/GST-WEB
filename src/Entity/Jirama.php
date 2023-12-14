<?php

namespace App\Entity;

use App\Repository\JiramaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JiramaRepository::class)]
class Jirama
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $PresDate;

    #[ORM\Column(type: 'float')]
    private $ValIndex;

    #[ORM\Column(type: 'date')]
    private $FactDate;

    #[ORM\Column(type: 'float')]
    private $Consomation;

    #[ORM\ManyToOne(targetEntity: Box::class, inversedBy: 'JiramaBox')]
    #[ORM\JoinColumn(nullable: false)]
    private $JirBox;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresDate(): ?\DateTimeInterface
    {
        return $this->PresDate;
    }

    public function setPresDate(\DateTimeInterface $PresDate): self
    {
        $this->PresDate = $PresDate;

        return $this;
    }

    public function getValIndex(): ?float
    {
        return $this->ValIndex;
    }

    public function setValIndex(float $ValIndex): self
    {
        $this->ValIndex = $ValIndex;

        return $this;
    }

    public function getFactDate(): ?\DateTimeInterface
    {
        return $this->FactDate;
    }

    public function setFactDate(\DateTimeInterface $FactDate): self
    {
        $this->FactDate = $FactDate;

        return $this;
    }

    public function getConsomation(): ?float
    {
        return $this->Consomation;
    }

    public function setConsomation(float $Consomation): self
    {
        $this->Consomation = $Consomation;

        return $this;
    }

    public function getJirBox(): ?Box
    {
        return $this->JirBox;
    }

    public function setJirBox(?Box $JirBox): self
    {
        $this->JirBox = $JirBox;

        return $this;
    }
}
