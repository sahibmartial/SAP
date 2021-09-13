<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('name',TextType::class,
           ['label'=>'Nom',
             'constraints'=> new Length(['min' => 2,'max' =>30]),
             'attr'=>
             ['placeholder'=>'Merci de saisir votre nom']
           ])
           ->add('lastname',TextType::class,
           ['label'=>'Prenom',
             'constraints'=> new Length(['min' => 2,'max' =>30]),
             'attr'=>
             ['placeholder'=>'Merci de saisir votre prenom']
           ])
            ->add('email',EmailType::class,['label'=>'Votre email',
            'constraints'=> new Length(['min' => 2,'max' =>60]),
            'attr'=>['placeholder'=>'Merci de saisir votre mail']
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
               'invalid_message' => 'Mot de pass et Confirmation doivent etre identique',
               'options' => ['attr' => ['class' => 'password-field']],
               'required' => true,
              'first_options'  => ['label' => 'Password',
              'attr'=>['placeholder'=>'Merci de saisir votre password']],
              'second_options' => ['label' => 'Confirm Password',
              'attr'=>['placeholder'=>'Merci de confirmer votre password']],
              ])  

            ->add('submit',SubmitType::class,
            ['label'=>"s'inscrire",
            'attr'=>['class'=>'btn btn-block btn-success']
            ])
       
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
