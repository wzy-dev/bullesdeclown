<?php

namespace App\Form;

use App\Entity\DataLeft;
use App\Form\ImageType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DataLeftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', CKEditorType::class, array('label'=>'Texte'))
            ->add('image', ImageType::class)
            ->add('submit', SubmitType::class, array('label'=>'Enregistrer l\'élément'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DataLeft::class,
        ]);
    }
}
