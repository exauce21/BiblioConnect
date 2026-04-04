<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Saisir votre email',
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Saisir votre mot de passe',
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Saisir votre nom',
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Saisir votre prénom',
                ]
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => 'Saisir votre numéro de téléphone',
                ]
            ])
            ->add('date_naissance', DateType::class, [
                'label' => 'Date de naissance',
                'attr' => [
                    'placeholder' => 'Saisir votre date de naissance (YYYY-MM-DD)',
                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'Saisir votre adresse',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
