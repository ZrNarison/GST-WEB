<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Pseudo;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $Photo;

    #[ORM\Column(type: 'string', length: 255)]
    private $MDP;
    
    public $Confirmation;

    #[ORM\OneToOne(targetEntity: Role::class, cascade: ['persist', 'remove'])]
    private $userRole;

    // public function __construct()
    // {
    //     $this->userRole = new ArrayCollection;
    // }

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
    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(string $Photo): self
    {
        $this->Photo = $Photo;

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
    public function getRoles(){
        $roles = ($this->userRole)->getTitle();
        return [$roles];
    }
        
    public function getPassword(){
        return $this->MDP;
    }
    public function getUsername(){
        return $this->Pseudo;
    }
    public function eraseCredentials(){}
    
    public function getSalt(){}

    public function getUserRole(): ?role
    {
        return $this->userRole;
    }

    public function setUserRole(?role $userRole): self
    {
        $this->userRole = $userRole;

        return $this;
    }
}
