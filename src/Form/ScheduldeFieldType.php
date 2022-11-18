<?php

namespace App\Form;

use App\Entity\ScheduldeField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ScheduldeFieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', HiddenType::class, [
                'required'=>false
            ])
            ->add('day', ChoiceType::class, array(
                'label'=>'Jour',
                'choices'=> [
                    'Lundi'=>1, 
                    'Mardi'=>2,   
                    'Mercredi'=>3,    
                    'Jeudi'=>4,    
                    'Vendredi'=>5,    
                    'Samedi'=>6,    
                    'Dimanche'=>7,   
                ]
            ))
            ->add('startTime', TimeType::class, array(
                'placeholder' => [
                    'hour' => 'Heure', 'minute' => 'Minute',
                ],
                'label'=>'Début de l\'événement'
            ))
            ->add('endTime', TimeType::class, array(
                'placeholder' => [
                    'hour' => 'Heure', 'minute' => 'Minute',
                ],
                'label'=>'Fin de l\'événement',
                'required'=>false
            ))
            ->add('place', TextType::class, array('label'=>'Lieu de l\'événement'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ScheduldeField::class,
        ]);
    }
}
