<?php

namespace App\Form;

use App\Form\AppType;
use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EditClientType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Fname',TextType::class, $this->conf('Nom',"Tapez ici le nom cu client"))
            ->add('Lname',TextType::class, $this->conf('Prénom',"Prénom",["required"=>false]))
            ->add('DateNaissance',DateType::class, $this->conf('Date de naissance'," ",["widget"=>"single_text"]))
            ->add('LieuNaissance',TextType::class, $this->conf('Lieu de naissance',"Lieu de naissance"))
            ->add('Piecejustificatif',ChoiceType::class,array(
                "choices"=>array(
                    "Acte de naissance"=> "Acte de naissance" ,
                    "Carte d'Identité National"=>"Carte d'Identité National",
                )
            ))
            ->add("Pj",TextType::class,$this->conf("N°:","Réference du piéce"))
            ->add('DateDelivrance',DateType::class, $this->conf('Date de délivrance'," ",["widget"=>"single_text"]))
            ->add('LieuDelivrance',TextType::class, $this->conf('Lieu de délivrance',"Lieu de délivrance"))
            ->add('Profession',TextType::class, $this->conf('Profession',"Profession"))
            ->add('FilliationPere',TextType::class, $this->conf('Nom du père',"Filliation père",["required"=>false]))
            ->add('FilliationMere',TextType::class, $this->conf('Nom du mère',"Filliation mère"))
            ->add('DateVente',DateType::class, $this->conf('Date de vente'," ",["widget"=>"single_text"]))
            ->add('Caution',IntegerType::class, $this->conf('Caution ','En chiffre',[
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'En chiffre',
                    'min'=>10000,
                    'max'=>100000000,
                    'step'=>0
                    ]
            ]))
            ->add('Adresse',TextType::class, $this->conf('Adresse',"Adresse"))
            ->add('Telephone')
            ->add('Email',EmailType::class, $this->conf('Email',"Adress email",["required"=>false]))
            ->add('SituationFamille',TextType::class, $this->conf('Situation Famille',"Situation familliale"))
            ->add('Epous',TextType::class, $this->conf('Epous(se)',"Nom de l'épous(se)",["required"=>false]))
            ->add('Enfants',IntegerType::class, $this->conf("Nombre d'enfants",'En chiffre',[
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'En chiffre',
                    'min'=>1,
                    'max'=>20,
                    'step'=>0
                    ]
            ]))
            ->add('NIF',IntegerType::class, $this->conf("Numéro d'Identité Fiscal ",'En chiffre',[
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'En chiffre',
                    'min'=>11111111,
                    'max'=>999999999,
                    'step'=>0
                    ]
            ]))
            ->add('STAT',IntegerType::class, $this->conf('Numéro Statistique ','En chiffre',[
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'En chiffre',
                    'min'=>1111111111,
                    'max'=>99999999999,
                    'step'=>0
                    ]
            ]))
            ->add('RCS',IntegerType::class, $this->conf('RCS ','En chiffre',[
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'En chiffre',
                    'min'=>1111111111,
                    'max'=>99999999999,
                    'step'=>0
                    ]
            ]))
            ->add('CompteBanque',IntegerType::class, $this->conf('N° Compte Bancaire ','En chiffre',[
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'En chiffre',
                    'min'=>1111111111,
                    'max'=>99999999999,
                    'step'=>0
                    ]
            ]))
            ->add('Activite',TextType::class, $this->conf('Activite',"Activite"))
            ->add('RoleActivite')
            ->add('NombreResponsable',IntegerType::class, $this->conf('NB Responsable ','En chiffre',[
                'required'=>true,
                'attr'=>[
                    'min'=>1,
                    'max'=>5,
                    'step'=>0
                    ]
            ]))
            ->add('MaterielUtiliser',TextType::class, $this->conf('Ouvrage',"Materiel utiliser"))
            ->add('DureeMateriel',IntegerType::class, $this->conf('Durée (mois)','En chiffre',[
                'required'=>false,
                'attr'=>[
                    'min'=>1,
                    'max'=>9999999999999999999999999999999,
                    'step'=>0
                    ]
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
