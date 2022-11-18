<?php

namespace App\Form;

use App\Entity\Rate;
use App\Form\RateFieldType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label'=>'Titre'))
            ->add('content', TextareaType::class, array('label'=>'Description'))
            ->add('fields', CollectionType::class, array(
                'entry_type'   => RateFieldType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'label'        => 'Tarif'
            ))
            ->add('submit', SubmitType::class, array('label'=>'Enregistrer l\'élément'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rate::class,
        ]);
    }
}
