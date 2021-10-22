<?php

namespace App\Form;

use App\Entity\Tclient;
use App\Entity\Tgritarett;
use App\Entity\Ttyporigta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GtaettType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', IntegerType::class, [
                'label' => 'Id',
                'attr' => ['readonly' => true],
                'disabled' => true,

            ])
            ->add('clrOrg', EntityType::class, [
                'label' => 'Client',
                'attr' => ['readonly' => true],
                'class' => Tclient::class,
                'disabled' => true,

            ])
            ->add('cod', TextType::class, [
                'label' => 'Code'
            ])
            ->add('dsg', TextType::class, [
                'label' => 'Désignation',
                'attr' => ['readonly' => false]
            ])
            ->add('clrTog', EntityType::class, [
                'label' => 'Origine',
                'placeholder' => "Saisir l'origine",
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                ],
                'class' => Ttyporigta::class,
                'choice_label' => function (Ttyporigta $ttyporigta) {
                    return $ttyporigta->getDsg();
                },
            ])

            ->add('datDeb', DateType::class, [
                'label' => 'Date de début',
                'attr' => ['readonly' => false],
                'widget' => 'single_text',
                'data' => new \DateTime("now"),
            ])
            ->add('datFin', DateType::class, [
                'label' => 'Date de fin',
                'attr' => ['readonly' => false],
                'widget' => 'single_text',
                'data' => new \DateTime("31-12-9999"),
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tgritarett::class,
        ]);
    }
}
