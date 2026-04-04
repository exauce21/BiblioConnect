<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Langue;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('annee_publication')
            ->add('image_couverture')
            ->add('stock_total')
            ->add('stock_disponible')
            ->add('created')
            ->add('langue', EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'id',
            ])
            ->add('auteur', EntityType::class, [
                'class' => Auteur::class,
                'choice_label' => 'id',
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
