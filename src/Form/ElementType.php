<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Présentation' => 'presentation',                  
                    'Couverture' => 'cover',
                    'Texte' => 'data',
                    'Texte avec image à droite' => 'dataLeft',
                    'Texte avec image à gauche' => 'dataRight',
                    'Tarifs' => 'rate',
                    'Horaires' => 'schedulde',
                    'Actualités' => 'articleBlock',
                    'Coordonnées' => 'information',  
                ],
                'expanded' => true,
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
