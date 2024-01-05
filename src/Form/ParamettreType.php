<?php

namespace App\Form;

use App\Form\AppType;
use App\Entity\Paramettre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ParamettreType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Societe',TextType::class, $this->conf('Societe',"Societe",))
            ->add('Representant',TextType::class, $this->conf('Representant',"Representant",["required"=>false]))
            ->add('Localisation',TextType::class, $this->conf('Localisation',"Localisation",["required"=>false]))
            ->add('Adresse',TextType::class, $this->conf('Adresse',"Adresse",["required"=>false]))
            ->add('Responsable',TextType::class, $this->conf('Responsable',"Responsable",["required"=>false]))
            ->add('Courant',IntegerType::class, $this->conf('Coût',"Courant",["required"=>false]))
            ->add('SJirama',IntegerType::class, $this->conf('Jirama',"Sous Jirama",["required"=>false]))
            ->add('SSP',IntegerType::class, $this->conf('SSP',"SSP",["required"=>false]))
            ->add('Redevence',IntegerType::class, $this->conf('Redevence national',"Redevence national",["required"=>false]))
            ->add('PrimeFixe',IntegerType::class, $this->conf('PrimeFixe',"Prime fixe",["required"=>false]))
            ->add('Redv',IntegerType::class, $this->conf('Redevence',"Redevence",["required"=>false]))
            ->add('Consommation',IntegerType::class, $this->conf('Consommation',"Consommation",["required"=>false]))
            ->add('Tva',IntegerType::class, $this->conf('Prénom',"Prénom",["required"=>false]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paramettre::class,
        ]);
    }
}
