<?php

namespace App\Form;

use App\Entity\ArticleBlock;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleBlockType extends AbstractType
{
    private $category;

    function __construct(array $category)
    {
        $new_line = array('all'=>'Toutes les catégories');
        $category=array_merge($new_line,$category);        
        $this->category= array_flip($category);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', ChoiceType::class, array(
                'choices' => $this->category
            ))
            ->add('submit', SubmitType::class, array('label'=>'Enregistrer l\'élément'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleBlock::class,
        ]);
    }
}
