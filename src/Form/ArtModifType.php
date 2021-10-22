<?php

namespace App\Form;

use App\Entity\Tuser;
use App\Entity\Tarticle;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArtModifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cod', TextType::class, [
                'label' => 'Code',

            ])
            ->add('xAct', CheckboxType::class, [
                'label' => 'Actif',

            ])
            ->add('datDebAct', DateType::class, [
                'label' => 'Actif du',
                'widget' => 'single_text',

            ])
            ->add('datFinAct', DateType::class, [
                'label' => "Actif jusqu'au",
                'widget' => 'single_text',

            ])

            ->add('libCrtFr', TextareaType::class, [
                'label' => 'Libellé court du site (FR)',

            ])
            ->add('libLngFr', TextareaType::class, [
                'label' => 'Libellé long du site (FR)',

            ])
            ->add('libCrtEn', TextareaType::class, [
                'label' => 'Libellé court du site (EN)',

            ])
            ->add('libLngEn', TextareaType::class, [
                'label' => 'Libellé long du site (EN)',

            ])
            ->add('lib01Adx', TextType::class, [
                'label' => 'Libellé Adonix',

            ])
            ->add('codEan', TextType::class, [
                'label' => 'Code EAN',

            ])
            ->add('pds', TextType::class, [
                'label' => 'Poids',

            ])
            ->add('pdsUnt', TextType::class, [
                'label' => 'Unité de poids',

            ])
            ->add('vlm', TextType::class, [
                'label' => 'Volume',

            ])
            ->add('vlmUnt', TextType::class, [
                'label' => 'Unité de volume',

            ])
            ->add('cpc', TextType::class, [
                'label' => "Capacité d'encre",

            ])
            ->add('cpcUnt', TextType::class, [
                'label' => "Unité de capacité d'encre",

            ])
            ->add('refCtr', TextType::class, [
                'label' => "Référence constructeur",

            ])
            ->add('lnkFchCtr', TextType::class, [
                'label' => "Lien fiche constructeur",

            ])
            ->add('refAdx', TextType::class, [
                'label' => "Référence Adonix",

            ])
            ->add('xAdx', CheckboxType::class, [
                'label' => 'Transfert Adonix',
                'attr' => array(
                    'readonly' => true,
                )
            ])
            ->add('datAdxIns', DateType::class, [
                'label' => 'Le',
                'widget' => 'single_text',
                'attr' => array(
                    'readonly' => true,
                )
            ])
            ->add('xSitWeb01', CheckboxType::class, [
                'label' => 'Transfert site web',
                'attr' => array(
                    'readonly' => true,
                )
            ])
            ->add('datSitWeb01Ins', DateType::class, [
                'label' => 'Le',
                'widget' => 'single_text',
                'attr' => array(
                    'readonly' => true,
                )
            ])
            ->add('usrIns', EntityType::class, [
                'label' => 'Créé par',
                'attr' => array(
                    'readonly' => true,
                ),
                'class' => Tuser::class,
                'choice_label' => function (Tuser $tuser) {
                    return $tuser->getNom();
                }
            ])
            ->add('datIns', DateType::class, [
                'label' => 'Le',
                'widget' => 'single_text',
                'attr' => array(
                    'readonly' => true,
                )
            ])
            ->add('usrUpd', EntityType::class, [
                'label' => 'Modifié par',
                'attr' => array(
                    'readonly' => true,
                ),
                'class' => Tuser::class,
                'choice_label' => function (Tuser $tuser) {
                    return $tuser->getNom();
                }
            ])
            ->add('datUpd', DateType::class, [
                'label' => 'Le',
                'widget' => 'single_text',
                'attr' => array(
                    'readonly' => true,
                )
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tarticle::class,
        ]);
    }
}
