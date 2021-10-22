<?php

namespace App\Form;

use App\Entity\Tcotation;
use App\Entity\Tfournisseur;
use App\Entity\Torganisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cod', TextType::class, [
                'label' => 'Code'
            ])
            ->add('dsg', TextType::class, [
                'label' => 'Désignation',
                'attr' => ['readonly' => false]
            ])
            ->add('clrFou', EntityType::class, [
                'label' => 'Fournisseur',
                'attr' => ['readonly' => false],
                'placeholder' => 'Sélectionnez un fournisseur',
                'class' => Tfournisseur::class,
                'choice_label' => function (Tfournisseur $tfournisseur) {
                    return $tfournisseur->getRso();
                },
            ])

            ->add('datDeb', DateType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
                'attr' => ['readonly' => false]

            ])
            ->add('datFin', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'attr' => ['readonly' => false]

            ])
            ->add('xAct', ChoiceType::class, [
                'label' => 'Actif',
                'attr' => [
                    'readonly' => false,
                ],
                'choices' => ['Oui' => true, 'Non' => false]

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tcotation::class,
        ]);
    }
}
