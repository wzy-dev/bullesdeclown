<?php

namespace App\Form;

use App\Entity\Schedulde;
use App\Form\ScheduldeFieldType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScheduldeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fields', CollectionType::class, array(
                'entry_type'   => ScheduldeFieldType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'label'        => 'Horaire',
            ))
            ->add('submit', SubmitType::class, array('label'=>'Enregistrer l\'élément'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Schedulde::class,
        ]);
    }
}
