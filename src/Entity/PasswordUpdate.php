<?php

namespace App\Entity;

use App\Repository\PasswordUpdateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



class PasswordUpdate
{
   
    private $oldPassword;

    /**
     * @Assert\Length(min=5,minMessage="Mot de pas trop court, il doit faire au moins six(6)caractéres !",max=20,maxMessage="Mot de pass ne doivent pas dépassé des vingt(20) caractéres !")
     */
    private $newPassword;

    /**
     * @Assert\EqualTo(propertyPath="newPassword",message="Votre code de confirmation de nouveau mot de pass est incorrect !")
     */

    private $confirmPassword;


    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword(?string $oldPassword): self
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(?string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }
}
