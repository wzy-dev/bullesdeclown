<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label'=>'Mon nom','attr'=>['placeholder'=>'Sophie Moreau']))
            ->add('email', TextType::class, array('label'=>'Mon email','attr'=>['placeholder'=>'sophie.moreau@gmail.com']))
            ->add('subject', TextType::class, array('label'=>'Objet','attr'=>['placeholder'=>'Demande de renseignements...']))
            ->add('body', TextareaType::class, array('label'=>'Mon message','attr'=>['placeholder'=>'Bonjour...','style'=>'height:100px']))
            ->add('submit', SubmitType::class, array('label'=>'Envoyer'))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Contact'
        ]);
    }
}