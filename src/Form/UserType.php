<?php
/**
 * Created by PhpStorm.
 * User: linux
 * Date: 05/02/19
 * Time: 17:23
 */

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType {

    #Para construir un formulario
    public function buildForm(FormBuilderInterface $builder, array $options){

        #definido en la parte de la llamada
        $builder
            ->add('username',TextType::class, [
                #atributos HTML con arrays associativos
                'required'=>'Required',
                'attr' => [
                    #clases de bootstrap
                    'class'=>'form-username form-control',
                    'placeholder'=>'Username'
                ]
            ])
            ->add('email', EmailType::class,[
                'required'=>'Required',
                'attr' => [
                    'class'=>'form-email form-control',
                    'placeholder'=>'Email@email'
                ]

            ])
            #plainpasswd es para que se incripte y se guarde
            #repeatType es para que se repita la contraseña
            ->add('plainpassword', RepeatedType::class,[
                #se pone para declarar cual es el que se repite
                'type'=>PasswordType::class,
                'required'=>'Required',
                'first_options'=>[
                    'attr'=>[
                        'class'=>'form-password form-control',
                        'placeholder'=>'Password'
                    ]
                ],
                'second_options'=>[
                    'attr'=>[
                        'class'=>'form-password form-control',
                        'placeholder'=>'Repeat password'
                    ]
                ]
            ]);

    }
    public function configureOptions(OptionsResolver $resolver){

        //el que resulve las mierdas del formulario
        $resolver->setDefaults(['data_class'=>'App\Entity\User']);
    }

}