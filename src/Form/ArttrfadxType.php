<?php

namespace App\Form;

use App\Entity\Tsite;
use App\Entity\Tmrqice;
use App\Entity\Ttaxadx;
use App\Entity\Tsociete;
use App\Entity\Tcodctaadx;
use App\Entity\Tfamartadx;
use App\Entity\Ttabpstadx;
use App\Data\ArttrfadxData;
use App\Entity\Tfournisseur;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ArttrfadxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cod', TextType::class, [
                'label' => 'Code article',
                'attr' => $options['attr'],
            ])
            ->add('libCrtFr', TextType::class, [
                'label' => 'Libellé du site web',
                'attr' => $options['attr'],

            ])
            ->add('refCtr', TextType::class, [
                'label' => 'Réf. constructeur',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                // 'attr' => $options['attr'],

            ])
            ->add('codArtAncAdx', TextType::class, [
                'label' => 'Ancien code article',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,

            ])
            ->add('clrMrqIce', EntityType::class, [
                'label' => 'Marque',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'placeholder' => 'Saisir la marque',
                'class' => Tmrqice::class,
                'required' => true,
                'choice_label' => function (Tmrqice $tmrqice) {
                    return $tmrqice->getNom();
                }
            ])

            ->add('codEan', TextType::class, [
                'label' => 'Code EAN',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,

            ])
            ->add('pds', NumberType::class, [
                'label' => 'Poids',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('pdsUnt', TextType::class, [
                'label' => 'Unité poids',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('lib01Adx', TextType::class, [
                'label' => 'Désignation 1 Adonix',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
            ])
            ->add('lib02Adx', TextType::class, [
                'label' => 'Désignation 2 Adonix',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('lib03Adx', TextType::class, [
                'label' => 'Désignation 3 Adonix',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('nrmAdx', TextType::class, [
                'label' => 'Norme',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('cleRchAdx', ChoiceType::class, [
                'label' => 'Clé (copycou)',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => true,
                'choices'  =>
                [
                    'STD-standard' => 'STD',
                    'ZCE-Centrale' => 'ZCE',
                    'ZDI- Direct ref centrale' => 'ZDI',
                    'ZLO- logistique' => 'ZLO',
                ],
            ])
            ->add('clrApcAdx', EntityType::class, [
                'label' => 'Appartenace',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tsociete::class,
                'placeholder' => '',
                'required' => true,
                'choice_label' => function (Tsociete $tsociete) {
                    return $tsociete->getCod();
                }
            ])
            ->add('tfamartadx01', EntityType::class, [
                'label' => 'Famille',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tfamartadx::class,
                'placeholder' => '',
                'required' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tfamartadx')
                        ->where("tfamartadx.codTab='21'")
                        ->orderBy('tfamartadx.dsg');
                }
            ])
            ->add('tfamartadx02', EntityType::class, [
                'label' => 'Sous famille',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tfamartadx::class,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tfamartadx')
                        ->where("tfamartadx.codTab='22'")
                        ->orderBy('tfamartadx.dsg');
                }
            ])
            ->add('tfamartadx03', EntityType::class, [
                'label' => 'Famille stat 4',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tfamartadx::class,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tfamartadx')
                        ->where("tfamartadx.codTab='23'")
                        ->orderBy('tfamartadx.dsg');
                }

            ])
            ->add('tcodctaadx', EntityType::class, [
                'label' => 'Code comptable',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tcodctaadx::class,
                'placeholder' => '',
                'choice_label' => function (Tcodctaadx $tcodctaadx) {
                    return $tcodctaadx->getCod();
                },
                'required' => true,
            ])
            ->add('ttaxadx', EntityType::class, [
                'label' => 'Niveau taxe',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Ttaxadx::class,
                'placeholder' => '',
                'required' => true,
                'choice_label' => function (Ttaxadx $ttaxadx) {
                    return $ttaxadx->getCod();
                }
            ])
            ->add('modGstAdx', ChoiceType::class, [
                'label' => 'Mode gestion',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'placeholder' => '',
                'required' => true,
                'choices'  =>
                [
                    'Sur Stock' => 'Sur Stock',
                    'A la commande' => 'A la commande',
                ],
                'required' => true,

            ])
            ->add('tsitStk01Adx', EntityType::class, [
                'label' => 'Site stockage 1',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tsite::class,
                'placeholder' => '',
                'required' => true,
                'choice_label' => function (Tsite $tsite) {
                    return $tsite->getCod();
                }
            ])
            ->add('tsitStk02Adx', EntityType::class, [
                'label' => 'Site stockage 2',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tsite::class,
                'placeholder' => '',
                'required' => false,
                'choice_label' => function (Tsite $tsite) {
                    return $tsite->getCod();
                }
            ])
            ->add('tsitPrpAdx', EntityType::class, [
                'label' => 'Site propriétaire',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tsite::class,
                'placeholder' => '',
                'required' => true,
                'choice_label' => function (Tsite $tsite) {
                    return $tsite->getCod();
                }
            ])
            ->add('tfou01', EntityType::class, [
                'label' => false,
                // 'label' => 'code fournisseur 1',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tfournisseur::class,
                'placeholder' => '',
                'required' => true,
                'choice_label' => function (Tfournisseur $tsite) {
                    return $tsite->getRso();
                }
            ])
            ->add('prtFou01', NumberType::class, [
                'label' => false,
                // 'label' => 'Priorité 1',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('codEan01', TextType::class, [
                'label' => false,
                // 'label' => 'Code EAN 1',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('codArt01', TextType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => true,
            ])
            ->add('xCntmrq01', ChoiceType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => true,
                'choices' => ['Oui' => true, 'Non' => false]
            ])
            ->add('tfou02', EntityType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tfournisseur::class,
                'placeholder' => '',
                'required' => false,
                'choice_label' => function (Tfournisseur $tsite) {
                    return $tsite->getRso();
                }
            ])
            ->add('prtFou02', NumberType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('codEan02', TextType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('codArt02', TextType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('xCntmrq02', ChoiceType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
                'choices' => ['Oui' => true, 'Non' => false]
            ])
            ->add('tfou03', EntityType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tfournisseur::class,
                'placeholder' => '',
                'required' => false,
                'choice_label' => function (Tfournisseur $tsite) {
                    return $tsite->getRso();
                },
            ])
            ->add('prtFou03', NumberType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,

            ])
            ->add('codEan03', TextType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,

            ])
            ->add('codArt03', TextType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('xCntmrq03', ChoiceType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
                'choices' => ['Oui' => true, 'Non' => false]
            ])
            ->add('tfou04', EntityType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Tfournisseur::class,
                'placeholder' => '',
                'required' => false,
                'choice_label' => function (Tfournisseur $tsite) {
                    return $tsite->getRso();
                },
            ])
            ->add('prtFou04', NumberType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,

            ])
            ->add('codEan04', TextType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,

            ])
            ->add('codArt04', TextType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('xCntmrq04', ChoiceType::class, [
                'label' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
                'choices' => ['Oui' => true, 'Non' => false]
            ])
            ->add('prxBasAdx', NumberType::class, [
                'label' => 'Prix de base',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => true,

            ])
            ->add('mrgMinAdx', NumberType::class, [
                'label' => 'Marge minimale',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => true,

            ])
            ->add('ctgAdx', ChoiceType::class, [
                'label' => 'Catégorie',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'placeholder' => '',
                'required' => true,
                'choices'  =>
                [
                    'STD1' => 'STD1',
                    'STD2' => 'STD2',
                    'STDL' => 'STDL',
                ],
                'required' => true,

            ])
            ->add('clrAhrAdx', EntityType::class, [
                'label' => 'Code acheteur',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'class' => Ttabpstadx::class,
                'placeholder' => '',
                'required' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('ttabpstadx')
                        ->where("ttabpstadx.clrTabadx=1")
                        ->orderBy('ttabpstadx.cod');
                }

            ])
            ->add('xGstEmpAdx', ChoiceType::class, [
                'label' => 'Gest. empl.',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false
                ],
                'choices' => ['Oui' => true, 'Non' => false]

            ])
            ->add('modReaAdx', ChoiceType::class, [
                'label' => 'Mode réappro',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false
                ],
                'choices' => [
                    'Pas de gestion' => '1',
                    'Réappro CBN' => '2',
                    'Réappro PDP' => '3',
                    'Réappro sur seuil' => '4',
                    'Recompl périodique' => '5',
                ]

            ])
            ->add('typSugAdx', ChoiceType::class, [
                'label' => 'Type suggestion',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false
                ],
                'choices' => [
                    'Pas de suggestion' => '1',
                    'Achats' => '2',
                    'Fabrication' => '3',
                    'Achats inter-site' => '4',
                    'Fabrication inter-site' => '5',
                ]

            ])
            ->add('seiReaAdx', IntegerType::class, [
                'label' => 'Seuil Réappro',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false
                ],

            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArttrfadxData::class,
            'method' => 'GET',
            'csrf_protection' => false,

        ]);
    }

    public function getBlockPrefix()
    {
        // return parent::getBlockPrefix();
        return '';
    }
}
