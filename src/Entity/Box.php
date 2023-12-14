<?php

namespace App\Entity;

use App\Repository\BoxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoxRepository::class)]
class Box
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Log;

    #[ORM\Column(type: 'float')]
    private $Sec;

    #[ORM\Column(type: 'string', length: 255)]
    private $Emplacement;

    #[ORM\Column(type: 'string', length: 255)]
    private $Num;

    #[ORM\OneToMany(mappedBy: 'JirBox', targetEntity: Jirama::class, orphanRemoval: true)]
    private $JiramaBox;

    public function __toString(): string
    {
        return $this->getNum();
    }

    public function __construct()
    {
        $this->JiramaBox = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLog(): ?string
    {
        return $this->Log;
    }

    public function setLog(string $Log): self
    {
        $this->Log = $Log;

        return $this;
    }

    public function getSec(): ?float
    {
        return $this->Sec;
    }

    public function setSec(float $Sec): self
    {
        $this->Sec = $Sec;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->Emplacement;
    }

    public function setEmplacement(string $Emplacement): self
    {
        $this->Emplacement = $Emplacement;

        return $this;
    }

    public function getNum(): ?string
    {
        return $this->Num;
    }

    public function setNum(string $Num): self
    {
        $this->Num = $Num;

        return $this;
    }

    /**
     * @return Collection<int, Jirama>
     */
    public function getJiramaBox(): Collection
    {
        return $this->JiramaBox;
    }

    public function addJiramaBox(Jirama $jiramaBox): self
    {
        if (!$this->JiramaBox->contains($jiramaBox)) {
            $this->JiramaBox[] = $jiramaBox;
            $jiramaBox->setJirBox($this);
        }

        return $this;
    }

    public function removeJiramaBox(Jirama $jiramaBox): self
    {
        if ($this->JiramaBox->removeElement($jiramaBox)) {
            // set the owning side to null (unless already changed)
            if ($jiramaBox->getJirBox() === $this) {
                $jiramaBox->setJirBox(null);
            }
        }

        return $this;
    }
}
