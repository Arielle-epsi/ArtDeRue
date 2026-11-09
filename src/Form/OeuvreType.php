<?php

namespace App\Form;

use App\Entity\Artistes;
use App\Entity\Lieux;
use App\Entity\Oeuvres;
use App\Entity\Techniques;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OeuvreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class)
            ->add('dateCreation', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date de création',
            ])
            ->add('description', TextareaType::class, ['required' => false])
            ->add('lieu', EntityType::class, [
                'class' => Lieux::class,
                'choice_label' => 'nom',
            ])
            ->add('artistes', EntityType::class, [
                'class' => Artistes::class,
                'choice_label' => 'pseudonyme',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('techniques', EntityType::class, [
                'class' => Techniques::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('oeuvreRecouverte', EntityType::class, [
                'class' => Oeuvres::class,
                'choice_label' => 'titre',
                'required' => false,
                'placeholder' => 'Aucune',
                'label' => 'Recouvre l\'œuvre',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Oeuvres::class]);
    }
}