<?php

namespace App\Form;

use App\Entity\RateField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RateFieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', HiddenType::class, [
                'required'=>false
            ])
            ->add('event', TextType::class, array('label'=>'Nom de l\'événement'))
            ->add('price', MoneyType::class, array('label'=>'Prix de l\'événement'))
            ->add('color', ChoiceType::class,array(
                'placeholder' => 'Choisissez une couleur...',
                'label' => 'Couleur du bloc tarif',
                'choices'  => [
                    'Vert' => '#52B39F',
                    'Bleu' => '#8FFFE9',
                    'Orange' => '#FF6D39',
                ],
                'choice_attr' => function($choice, $key, $value) {
                    return ['class' => 'option--'.str_replace(' ','',strtolower($key))];
                },
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RateField::class,
        ]);
    }
}
