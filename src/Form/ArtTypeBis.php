<?php

namespace App\Form;

use App\Entity\Tctgice;
use App\Entity\Tmrqice;
use App\Entity\Tarticle;
use App\Entity\Tctgicearb;
use App\Entity\Tctgiceniv;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArtTypeBis extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('cod', TextType::class, [
                'label' => 'Code',
                'attr' => $options['attr'],

            ])
            ->add('xAct', ChoiceType::class, [
                'label' => 'Actif',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false
                ],
                'choices' => ['Oui' => true, 'Non' => false]

            ])
            ->add('datDebAct', DateType::class, [
                'label' => 'Actif du',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'widget' => 'single_text',

            ])
            ->add('datFinAct', DateType::class, [
                'label' => "Actif jusqu'au",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
                'widget' => 'single_text',

            ])
            ->add('clrMrqice', EntityType::class, [
                'label' => 'Marque',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'placeholder' => 'Saisir la marque',
                'class' => Tmrqice::class,
                'required' => false,
                'choice_label' => function (Tmrqice $tmrqice) {
                    return $tmrqice->getNom();
                }
            ])
            ->add('clrCtgice', EntityType::class, [
                'label' => 'Catégorie',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'placeholder' => 'Saisir le code catégorie',
                'class' => Tctgicearb::class,
                'required' => false,
                'choice_label' => function (Tctgicearb $tctgicearb) {
                    return $tctgicearb->getid();
                }
            ])
            // ->add('tctgice', EntityType::class, [
            //     'label' => false,
            //     'required' => false,
            //     'mapped' => false,
            //     'class' => Tctgiceniv::class,
            //     // 'attr' => [
            //     'placeholder' => 'Saisissez Catégorie niveau 1',
            //     // ],
            //     'query_builder' => function (EntityRepository $er) {
            //         return $er->createQueryBuilder('tctgiceniv')
            //         ->where('tctgiceniv.niv=1')
            //         ->orderBy('tctgiceniv.dsg');
            //     }
            //     // 'expanded' => true,
            //     // 'multiple' => true
            // ])
            // ->add('tsctgice', EntityType::class, [
            //     'label' => false,
            //     'required' => false,
            //     'mapped' => false,
            //     'class' => Tctgiceniv::class,
            //     // 'attr' => [
            //     'placeholder' => 'Saisissez Catégorie niveau 2',
            //     // ],
            //     'query_builder' => function (EntityRepository $er) {
            //         return $er->createQueryBuilder('tctgiceniv')
            //         ->where('tctgiceniv.niv=5')
            //         ->orderBy('tctgiceniv.dsg');
            //     }
            //     //     // 'expanded' => true,
            //     //     // 'multiple' => true
            // ])
            // ->add('tssctgice', EntityType::class, [
            //     'label' => false,
            //     'required' => false,
            //     'mapped' => false,
            //     'class' => Tctgiceniv::class,
            //     // 'attr' => [
            //     'placeholder' => 'Saisissez Catégorie niveau 3',
            //     // ],
            //     'query_builder' => function (EntityRepository $er) {
            //         return $er->createQueryBuilder('tctgiceniv')
            //         ->where('tctgiceniv.niv=5')
            //         ->orderBy('tctgiceniv.dsg');
            //     }
            //     //     // 'expanded' => true,
            //     //     // 'multiple' => true
            // ])
            // ->add('tsssctgice', EntityType::class, [
            //     'label' => false,
            //     'required' => false,
            //     'mapped' => false,
            //     'class' => Tctgiceniv::class,
            //     // 'attr' => [
            //     'placeholder' => 'Saisissez Catégorie niveau 4',
            //     // ],
            //     'query_builder' => function (EntityRepository $er) {
            //         return $er->createQueryBuilder('tctgiceniv')
            //         ->where('tctgiceniv.niv=5')
            //         ->orderBy('tctgiceniv.dsg');
            //     }
            //     //     // 'expanded' => true,
            //     //     // 'multiple' => true
            // ])
            ->add('libCrtFr', TextareaType::class, [
                'label' => 'Libellé court du site (FR)',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('libLngFr', TextareaType::class, [
                'label' => 'Libellé long du site (FR)',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('libCrtEn', TextareaType::class, [
                'label' => 'Libellé court du site (EN)',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('libLngEn', TextareaType::class, [
                'label' => 'Libellé long du site (EN)',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('lib01Adx', TextType::class, [
                'label' => 'Libellé Adonix',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('codEan', TextType::class, [
                'label' => 'Code EAN',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('pds', TextType::class, [
                'label' => 'Poids',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('pdsUnt', TextType::class, [
                'label' => 'Unité de poids',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('vlm', TextType::class, [
                'label' => 'Volume',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('vlmUnt', TextType::class, [
                'label' => 'Unité de volume',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('cpc', TextType::class, [
                'label' => "Capacité d'encre",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('cpcUnt', TextType::class, [
                'label' => "Unité de capacité d'encre",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('refCtr', TextType::class, [
                'label' => "Référence constructeur",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('lnkFchCtr', TextType::class, [
                'label' => "Lien fiche constructeur",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('refAdx', TextType::class, [
                'label' => "Référence Adonix",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('xAdx', CheckboxType::class, [
                'label' => 'Transfert Adonix',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('datAdxIns', DateType::class, [
                'label' => 'Le',
                'widget' => 'single_text',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('xSitWeb01', CheckboxType::class, [
                'label' => 'Transfert site web',
                'required' => false,
            ])
            ->add('datSitWeb01Ins', DateType::class, [
                'label' => 'Le',
                'widget' => 'single_text',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('img', TextType::class, [
                'label' => "Photo",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ])
            ->add('img2', FileType::class, [
                'label' => "Photo",
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
            ]);;;;
    }
    //     $builder->get('tctgice')->addEventListener(

    //         //  FormEvents::POST_SUBMIT,
    //         FormEvents::POST_SUBMIT,
    //         function (FormEvent $event) {

    //             $idctg = $event->getData();

    //             $form = $event->getForm();

    //             if ($idctg) {
    //                 $this->addCtgiceniv2Field($form->getParent(), $idctg);
    //                 // dump($event);
    //                 // $form->getParent()->add('tsctgice', EntityType::class, [
    //                 //     'label' => false,
    //                 //     'required' => false,
    //                 //     'mapped' => false,
    //                 //     'class' => Tctgiceniv::class,
    //                 //     // 'attr' => [
    //                 //     // 'placeholder' => 'Sous Catégorie'
    //                 //     // ],
    //                 //     'query_builder' => function (EntityRepository $er) use ($idctg) {
    //                 //         //  $idctg = $event->getData();

    //                 //         $rqt = $er->createQueryBuilder('tctgiceniv')
    //                 //         ->where('tctgiceniv.niv=2')
    //                 //         ->andwhere('tctgiceniv.clrCtgiceprc= :id')
    //                 //         ->setParameter('id', $idctg)
    //                 //             ->orderBy('tctgiceniv.dsg');
    //                 //         return $rqt;
    //                 //     }
    //                 // ]);

    //             }
    //         }
    //     );
    // }
    // private function addCtgiceniv2Field(FormInterface $form, $idctg)
    // {
    //     $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
    //         'tsctgice',
    //         EntityType::class,
    //         null,
    //         [
    //             'label' => false,
    //             'required' => false,
    //             'mapped' => false,
    //             'class' => Tctgiceniv::class,
    //             'auto_initialize' => false,
    //             // 'attr' => [
    //             'placeholder' => 'Sous Catégorie',
    //             // ],
    //             'query_builder' => function (EntityRepository $er) use ($idctg) {
    //                 //  $idctg = $event->getData();

    //                 $rqt = $er->createQueryBuilder('tctgiceniv')
    //                     ->where('tctgiceniv.niv=2')
    //                     ->andwhere('tctgiceniv.clrCtgiceprc= :id')
    //                     ->setParameter('id', $idctg)
    //                     ->orderBy('tctgiceniv.dsg');
    //                 return $rqt;
    //             }
    //         ]
    //     );
    //     $builder->addEventListener(
    //         FormEvents::POST_SUBMIT,
    //         function (FormEvent $event) {
    //             $form = $event->getForm();
    //             $idctg = $event->getData();
    //             $this->addCtgiceniv3FieldBis($form->getParent(), $idctg);
    //         }
    //     );
    //     $form->add($builder->getForm());
    //     //         $builder = $form->getParent()->getConfig()->getFormFactory()->createNamedBuilder(
    //     //             'tssctgice',
    //     //             EntityType::class,
    //     //             null,
    //     //             [
    //     //                 'label' => false,
    //     //                 'required' => false,
    //     //                 'mapped' => false,
    //     //                 'class' => Tctgiceniv::class,
    //     //                 'auto_initialize' => false,
    //     //                 // 'attr' => [
    //     //                 // 'placeholder' => 'Sous Catégorie'
    //     //                 // ],
    //     //                 'query_builder' => function (EntityRepository $er) use ($idctg2) {
    //     //                     //  $idctg = $event->getData();

    //     //                     $rqt = $er->createQueryBuilder('tctgiceniv')
    //     //                     ->where('tctgiceniv.niv=3')
    //     //                     ->andwhere('tctgiceniv.clrCtgiceprc= :id')
    //     //                     ->setParameter('id', $idctg2)
    //     //                         ->orderBy('tctgiceniv.dsg');
    //     //                     return $rqt;
    //     //                 }
    //     //             ]
    //     // );
    // }

    // private function addCtgiceniv3Field(FormInterface $form, $idctg)
    // {
    //     $form->add('tssctgice', EntityType::class, [
    //         'class'       => EntityType::class,
    //         'label' => false,
    //         'required' => false,
    //         'mapped' => false,
    //         'class' => Tctgiceniv::class,
    //         'auto_initialize' => false,
    //         // 'attr' => [
    //         'placeholder' => 'Sous Sous Catégorie',
    //         // ],
    //         'query_builder' => function (EntityRepository $er) use ($idctg) {
    //             //  $idctg = $event->getData();

    //             $rqt = $er->createQueryBuilder('tctgiceniv')
    //                 ->where('tctgiceniv.niv=3')
    //                 ->andwhere('tctgiceniv.clrCtgiceprc= :id')
    //                 ->setParameter('id', $idctg)
    //                 ->orderBy('tctgiceniv.dsg');
    //             return $rqt;
    //         }
    //     ]);
    // }
    // private function addCtgiceniv3FieldBis(FormInterface $form, $idctg)
    // {
    //     $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
    //         'tssctgice',
    //         EntityType::class,
    //         null,
    //         [
    //             'label' => false,
    //             'required' => false,
    //             'mapped' => false,
    //             'class' => Tctgiceniv::class,
    //             'auto_initialize' => false,
    //             // 'attr' => [
    //             'placeholder' => 'Sous sous sous  Catégorie',
    //             // ],
    //             'query_builder' => function (EntityRepository $er) use ($idctg) {
    //                 //  $idctg = $event->getData();

    //                 $rqt = $er->createQueryBuilder('tctgiceniv')
    //                     ->where('tctgiceniv.niv=3')
    //                     ->andwhere('tctgiceniv.clrCtgiceprc= :id')
    //                     ->setParameter('id', $idctg)
    //                     ->orderBy('tctgiceniv.dsg');
    //                 return $rqt;
    //             }
    //         ]
    //     );
    //     $builder->addEventListener(
    //         FormEvents::POST_SUBMIT,
    //         function (FormEvent $event) {
    //             $form = $event->getForm();
    //             $idctg = $event->getData();
    //             $this->addCtgiceniv4Field($form->getParent(), $idctg);
    //             // $this->addCtgiceniv3Field($form->getParent(), $form->getData());
    //         }
    //     );
    //     $form->add($builder->getForm());
    // }
    // private function addCtgiceniv4Field(FormInterface $form, $idctg)
    // {
    //     $form->add('tsssctgice', EntityType::class, [
    //         'class'       => EntityType::class,
    //         'label' => false,
    //         'required' => false,
    //         'mapped' => false,
    //         'class' => Tctgiceniv::class,
    //         'auto_initialize' => false,
    //         // 'attr' => [
    //         // 'placeholder' => 'Sous Catégorie'
    //         // ],
    //         'query_builder' => function (EntityRepository $er) use ($idctg) {
    //             //  $idctg = $event->getData();

    //             $rqt = $er->createQueryBuilder('tctgiceniv')
    //                 ->where('tctgiceniv.niv=4')
    //                 ->andwhere('tctgiceniv.clrCtgiceprc= :id')
    //                 ->setParameter('id', $idctg)
    //                 ->orderBy('tctgiceniv.dsg');
    //             return $rqt;
    //         }
    //     ]);
    // }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tarticle::class,
        ]);
    }
    public function getBlockPrefix()
    {
        // return parent::getBlockPrefix();
        return '';
    }
}
