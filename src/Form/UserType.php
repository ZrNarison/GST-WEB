<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use App\Form\AppType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Pseudo',TextType::class, $this->conf('Pseudo',"Tapez ici le nom"))
            ->add('MDP',PasswordType::class, $this->conf('Mot de passe',"Code secret"))
            ->add('Role',EntityType::class,[
                'class'=>Role::class,
                'label'=>'Role',
                'placeholder' => "Veuillez séléctionner un role"
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
