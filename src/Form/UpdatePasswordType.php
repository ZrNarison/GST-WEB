<?php

namespace App\Form;

use App\Form\AppType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UpdatePasswordType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('oldPassword',PasswordType::class,$this->conf("Ancien mot de pass :", "Votre ancien mot de pass"))
        ->add('newPassword',PasswordType::class,$this->conf("Nouveau mot de pass :", "Votre nouveau mot de pass"))
        ->add('confirmPassword',PasswordType::class,$this->conf("Confirmation mot de pass :", "Confirmation de vos nouveau mot de pass"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
