<?php

namespace App\Entity;
class Filtre
{

    #[ORM\Column(type: 'string', nullable: true)]
    private $DateFilter;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Box;

    public function getDateFilter(): ?string
    {
        return $this->DateFilter;
    }

    public function setDateFilter(?string $DateFilter): self
    {
        $this->DateFilter = $DateFilter;

        return $this;
    }

    public function getBox(): ?string
    {
        return $this->Box;
    }

    public function setBox(?string $Box): self
    {
        $this->Box = $Box;

        return $this;
    }
}
