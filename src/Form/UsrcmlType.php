<?php

namespace App\Form;

use App\Entity\Tuser;
use App\Entity\Tusrcml;
use App\Entity\Tcommercial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UsrcmlType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clrUsr', EntityType::class, [
                'label' => 'Utilisateur',
                'attr' => $options['attr'],
                'placeholder' => "Sélectionnez l'utilisateur",
                'class' => Tuser::class,
                'choice_label' => function (Tuser $tuser) {
                    return $tuser->getEmail();
                },
            ])
            ->add('clrCml', EntityType::class, [
                'label' => 'Commercial',
                'attr' => $options['attr'],
                'placeholder' => "Sélectionnez le code commercial",
                'class' => Tcommercial::class,
                'choice_label' => function (Tcommercial $tcommercial) {
                    return $tcommercial->getCod();
                },

            ]);
        $builder
            ->add('datDeb', DateType::class, [
                'label' => 'Date de début',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

                'widget' => 'single_text',
                // 'data' => new \DateTime("now"),
            ])
            ->add('datFin', DateType::class, [
                'label' => 'Date de fin',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'widget' => 'single_text',
                // 'data' => new \DateTime("31-12-9999"),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tusrcml::class,
        ]);
    }
}
