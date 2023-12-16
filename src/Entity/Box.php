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
    private $Num;

    #[ORM\OneToMany(mappedBy: 'JirBox', targetEntity: Jirama::class, orphanRemoval: true)]
    private $JiramaBox;

    #[ORM\OneToOne(mappedBy: 'Box', targetEntity: Client::class, cascade: ['persist', 'remove'])]
    private $client;

    #[ORM\ManyToOne(targetEntity: Emplacement::class, inversedBy: 'boxes')]
    #[ORM\JoinColumn(nullable: false)]
    private $SitBox;

    #[ORM\OneToMany(mappedBy: 'Box', targetEntity: Client::class, orphanRemoval: true)]
    private $clients;

    public function __toString()
    {
        return $this->getNum();
    }

    public function __construct()
    {
        $this->JiramaBox = new ArrayCollection();
        $this->clients = new ArrayCollection();
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
        $this->Log = mb_strtoupper($Log);

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        // set the owning side of the relation if necessary
        if ($client->getBox() !== $this) {
            $client->setBox($this);
        }

        $this->client = $client;

        return $this;
    }

    public function getSitBox(): ?Emplacement
    {
        return $this->SitBox;
    }

    public function setSitBox(?Emplacement $SitBox): self
    {
        $this->SitBox = $SitBox;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setBox($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getBox() === $this) {
                $client->setBox(null);
            }
        }

        return $this;
    }
}
