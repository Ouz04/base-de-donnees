<?php

namespace App\Form;

use App\Entity\Tctgiceniv;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CtgiceType extends AbstractType
{
    private $vReadonly;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['action'] == '02') {
            $vReadonly = true;
        } else {
            $vReadonly = false;
        }
        $builder
            ->add('idIce', TextType::class, [
                'label' => 'Code Icecat',
            ])
            ->add('dsg', TextType::class, [
                'label' => 'Catégorie',
                'attr' => ['readonly' => false]


            ])

            ->add('dsg', TextType::class, [
                'label' => 'Désignation',
                'attr' => ['readonly' => false]

            ])
            ->add('niv', IntegerType::class, [
                'label' => 'Niveau hiérachique',
                'attr' => ['readonly' => false]

            ])

            ->add('clrCtgiceprc', EntityType::class, [
                'label' => 'Catégorie niveau supérieur',
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                ],
                'placeholder' => '',
                'class' => Tctgiceniv::class,
                'required' => false,
                'choice_label' => function (Tctgiceniv $tctgiceniv) {
                    return $tctgiceniv->getDsg();
                }
            ])
            ->add('xAct', ChoiceType::class, [
                'label' => 'Actif',
                'attr' => [
                    'readonly' => false,
                    'required' => false
                ],
                'choices' => ['Oui' => true, 'Non' => false]

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tctgiceniv::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
