<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //el contructor
        $builder
            ->add('title')
            ->add('content')
            ->add('createdAt')
            ->add('publishedAt')
            ->add('modifiedAt')
            ->add('author')
            ->add('user')
            ->add('tags')
        ;
    }
    //el que resuelve cosas
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
