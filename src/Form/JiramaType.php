<?php

namespace App\Form;

use App\Entity\Box;
use App\Form\AppType;
use App\Entity\Jirama;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class JiramaType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('JirBox',EntityType::class,[
                'class'=>Box::class,
                'label'=>'N° Box',
                'placeholder' => "Veuillez séléctionner un box"
                ])
            ->add('PresDate',DateType::class, $this->conf('Date prélevement'," ",["widget"=>"single_text"]))
            ->add('ValIndex',IntegerType::class, $this->conf('Index ','En chiffre',[
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'En chiffre',
                    'min'=>1,
                    'max'=>250,
                    'step'=>0
                    ]
            ]))
            ->add('FactDate',DateType::class, $this->conf('Date facturation'," ",["widget"=>"single_text"]))
            ->add('Consomation',IntegerType::class, $this->conf('Consommation ','En chiffre',[
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'En chiffre',
                    'min'=>1,
                    'max'=>250,
                    'step'=>0
                    ]
            ]))
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jirama::class,
        ]);
    }
}
