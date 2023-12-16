<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Pseudo;

    #[ORM\Column(type: 'string', length: 255)]
    private $MDP;

    #[ORM\OneToOne(targetEntity: Role::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $Role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->Pseudo;
    }

    public function setPseudo(string $Pseudo): self
    {
        $this->Pseudo = mb_strtoupper($Pseudo);

        return $this;
    }

    public function getMDP(): ?string
    {
        return $this->MDP;
    }

    public function setMDP(string $MDP): self
    {
        $this->MDP = $MDP;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->Role;
    }

    public function setRole(Role $Role): self
    {
        $this->Role = $Role;

        return $this;
    }
}
