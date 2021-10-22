<?php

namespace App\Form;

use App\Entity\Tcotorg;
use App\Entity\Tcotation;
use App\Entity\Torganisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CotorgType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clrCot', EntityType::class, [
                'label' => 'Code cotation',
                'attr' => $options['attr'],
                'placeholder' => 'Sélectionnez le code cotation',
                'class' => Tcotation::class,
                'choice_label' => function (Tcotation $tcotation) {
                    return $tcotation->getCod();
                },

            ])
            ->add('clrOrg', EntityType::class, [
                'label' => 'Code organisation',
                'attr' => $options['attr'],
                'placeholder' => 'Sélectionnez le code organisation',
                'class' => Torganisation::class,
                'choice_label' => function (Torganisation $torganisation) {
                    return $torganisation->getCod();
                }
            ])
            ->add('datDeb', DateType::class, [
                'label' => 'Date de fin',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'widget' => 'single_text',
            ])
            ->add('datFin', DateType::class, [
                'label' => 'Date de début',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'widget' => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tcotorg::class,
        ]);
    }
}
