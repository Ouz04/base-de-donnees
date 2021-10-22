<?php

namespace App\Form;

use App\Entity\Tartfou;
use App\Entity\Tarticle;
use App\Entity\Tcotation;
use App\Entity\Tfournisseur;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ArtfouType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codArtFrm', TextType::class, [
                'label' => 'Code article',
                'attr' => $options['attr'],

            ])
            ->add('clrFou', EntityType::class, [
                'label' => 'Code fournisseur',
                'attr' => $options['attr'],
                'placeholder' => "Sélectionnez le code fournisseur",
                'class' => Tfournisseur::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tfournisseur')
                        ->where('tfournisseur.xAct=true')
                        ->orderBy('tfournisseur.cod');
                }
                // 'choice_label' => function (Tfournisseur $tfournisseur) {
                //     return $tfournisseur->getCod();
                // }
            ])
            ->add('clrCot', EntityType::class, [
                'label' => 'Code cotation',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
                'placeholder' => "Sélectionnez le code cotation",
                'class' => Tcotation::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tcotation')
                        ->where('tcotation.xAct=true')
                        ->orderBy('tcotation.cod');
                }

            ])
            ->add('qteCnd', IntegerType::class, [
                'label' => 'Conditionnement',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('qteMin', IntegerType::class, [
                'label' => 'Quantité minimum',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('qteMax', IntegerType::class, [
                'label' => 'Quantité maximum',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
            ])            
            ->add('qteStk', IntegerType::class, [
                'label' => 'Stock',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('datPrx', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])

            ->add('prxAch', NumberType::class, [
                'label' => 'Prix achat',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('prxPbl', NumberType::class, [
                'label' => "Prix public",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('prxTxe', NumberType::class, [
                'label' => "Ecotaxe",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('prxTxs', NumberType::class, [
                'label' => "Taxe sorecop",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('dev', TextType::class, [
                'label' => "Devise",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('xCntmrq', ChoiceType::class, [
                'label' => 'Contre marque',
                'attr' => [
                    'readonly' => false,
                ],
                'choices' => ['Oui' => true, 'Non' => false]

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
            'data_class' => Tartfou::class,
        ]);
    }
}
