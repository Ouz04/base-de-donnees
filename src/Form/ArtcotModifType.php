<?php

namespace App\Form;

use App\Entity\Tuser;
use App\Entity\Tartcot;
use App\Entity\Tarticle;
use App\Entity\Tcotation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ArtcotModifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clrArt', TextType::class, [
                'label' => 'Code article',
                'attr' => array(
                    'readonly' => true,
                ),

            ])
            ->add('clrCot', EntityType::class, [
                'label' => 'Code cotation',
                'attr' => [
                    'placeholder' => 'Sélectionnez le code cotation',
                    'readonly' => true
                ],
                'class' => Tcotation::class,
                'choice_label' => function (Tcotation $tcotation) {
                    return $tcotation->getCod();
                }
            ])
            ->add('qteCnd', IntegerType::class, [
                'label' => 'Conditionnement',

            ])
            ->add('qteArt', IntegerType::class, [
                'label' => 'Quantité article',
            ])

            ->add('prx', NumberType::class, [
                'label' => 'Prix achat',

            ])
            ->add('dev', TextType::class, [
                'label' => "Devise",

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
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tartcot::class,
        ]);
    }
}
