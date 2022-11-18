<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    private $category;

    function __construct(array $category)
    {
        $this->category= array_flip($category);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', CKEditorType::class, array('label'=>'Texte'))
            ->add('title', TextType::class, array('label'=>'Titre'))
            ->add('category', ChoiceType::class, array(
                'label' => 'Catégorie',
                'choices' => $this->category
            ))
            ->add('helloAsso', TextType::class, array(
                'label'=>'HelloAsso',
                'required'=>false,
                'attr' => array(
                    'placeholder' => 'Copier ici le lien de l\'événement',
                )
            ))
            ->add('submit', SubmitType::class, array('label'=>'Enregistrer l\'article'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
