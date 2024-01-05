<?php

namespace App\Form;

use App\Entity\Box;
use App\Form\AppType;
use App\Entity\Filtre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientFiltreType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Box',EntityType::class,[
                'class'=>Box::class,
                'label'=>false,
                'placeholder' => "Veuillez séléctionner un box"
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filtre::class,
            'methode' => 'get',
            'csrf_protection' =>false ,
        ]);
    }
}
