<?php

namespace App\Entity;

use App\Repository\EmplacementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmplacementRepository::class)]
class Emplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Situe;

    #[ORM\OneToMany(mappedBy: 'SitBox', targetEntity: Box::class, orphanRemoval: true)]
    private $boxes;

    #[ORM\Column(type: 'string', length: 255)]
    private $Slug;

    public function __construct()
    {
        $this->boxes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getSitue();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSitue(): ?string
    {
        return $this->Situe;
    }

    public function setSitue(string $Situe): self
    {
        $this->Situe = mb_strtoupper($Situe);

        return $this;
    }

    /**
     * @return Collection<int, Box>
     */
    public function getBoxes(): Collection
    {
        return $this->boxes;
    }

    public function addBox(Box $box): self
    {
        if (!$this->boxes->contains($box)) {
            $this->boxes[] = $box;
            $box->setSitBox($this);
        }

        return $this;
    }

    public function removeBox(Box $box): self
    {
        if ($this->boxes->removeElement($box)) {
            // set the owning side to null (unless already changed)
            if ($box->getSitBox() === $this) {
                $box->setSitBox(null);
            }
        }

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
