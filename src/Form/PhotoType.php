<?php

namespace App\Form;

use App\Entity\Benevoles;
use App\Entity\Oeuvres;
use App\Entity\Photos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oeuvre', EntityType::class, [
                'class' => Oeuvres::class,
                'choice_label' => 'titre',
                'label' => 'Œuvre photographiée',
            ])
            ->add('benevole', EntityType::class, [
                'class' => Benevoles::class,
                'choice_label' => fn (Benevoles $b) => $b->getPrenom() . ' ' . $b->getNom(),
                'label' => 'Photo prise par',
            ])
            ->add('datePriseVue', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date de prise de vue',
            ])
            ->add('etatOeuvre', TextType::class, [
                'required' => false,
                'label' => 'État de l\'œuvre',
            ])
            ->add('photo', FileType::class, [
                'mapped' => false,
                'label' => 'Photo',
                'constraints' => [
                    new File(
                        maxSize: '5M',
                        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
                        mimeTypesMessage: 'Envoie une image JPEG, PNG ou WebP.',
                    ),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Photos::class]);
    }
}