<?php

namespace App\Form;

use App\Entity\Box;
use App\Form\AppType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BoxType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Num',IntegerType::class, $this->conf('N° ','En chiffre ',[
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'En chiffre',
                    'min'=>1,
                    'max'=>99,
                    'step'=>0000000000000000
                    ]
                ]))
            ->add('Log',IntegerType::class, $this->conf('Coût du logement ','En chiffre',[
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'En chiffre',
                    'min'=>100000,
                    'max'=>450000,
                    'step'=>0
                    ]
            ]))
            ->add('Sec',IntegerType::class, $this->conf('Coût du Sécurité ','En chiffre',[
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'En chiffre',
                    'min'=>50000,
                    'max'=>250000,
                    'step'=>0
                    ]
            ]))
            ->add('Emplacement',TextType::class, $this->conf('Emplacement',"Tapez ici l'emplacment"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Box::class,
        ]);
    }
}
