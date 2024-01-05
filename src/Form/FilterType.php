<?php

namespace App\Form;

use App\Form\AppType;
use App\Entity\Filtre;
use App\Entity\Jirama;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FilterType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateFilter',EntityType::class,[
                'class'=>Jirama::class,
                'label'=>false,
                'group_by'=>'FactDate',
                'placeholder' => "Veuillez séléctionner une date"
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
