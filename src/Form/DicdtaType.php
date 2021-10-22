<?php

namespace App\Form;

use App\Entity\Tdicdta;
use App\Entity\Tdictab;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class DicdtaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
                ->add('tabnam', TextType::class, [
                    'label' => 'Table',
                    'attr' => [
                        'readonly' => false,
                        'disabled' => false,
                    ],
                 ])    
                ->add('chpnam', TextType::class, [
                    'label' => 'Champs',
                    'attr' => [
                        'readonly' => false,
                        'disabled' => false,
                    ],
                ])
           
                ->add('typ', TextType::class, [
                    'label' => 'Type',
                    'attr' => [
                        'readonly' => false,
                        'disabled' => false,
                    ],
                ])
                ->add('lng', TextType::class, [
                    'label' => 'Long',
                    'attr' => [
                        'readonly' => false,
                        'disabled' => false,
                    ],
                ])
                ->add('rng', IntegerType::class, [
                    'label' => 'Rang',
                    'attr' => [
                        'readonly' => false,
                        'disabled' => false,
                    ],
                ])
                ->add('ctq', TextType::class, [
                    'label' => 'Ctq',
                    'attr' => [
                        'readonly' => false,
                        'disabled' => false,
                    ],
                ])
                ->add('dsg', TextType::class, [
                    'label' => 'Désignation',
                    'attr' => [
                        'readonly' => false,
                        'disabled' => false,
                    ],
                ])
           
            ;
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tdicdta::class,
        ]);
    }
}
