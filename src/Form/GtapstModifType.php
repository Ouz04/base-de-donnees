<?php

namespace App\Form;

use App\Entity\Tuser;
use App\Entity\Tarticle;
use App\Entity\Tgritarett;
use App\Entity\Tgritarpst;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class GtapstModifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clrGta', EntityType::class, [
                'label' => 'Code grille tarifaire',
                'choice_label' => function (Tgritarett $tgritarett) {
                    return $tgritarett->getCod();
                },
                'attr' => array(
                    'readonly' => true,
                ),
                'class' => Tgritarett::class,
            ])
            ->add('clrArt', EntityType::class, [
                'label' => 'Code article',
                'attr' => [
                    'placeholder' => '-- Sélectionnez le code article --'
                ],
                'class' => Tarticle::class,
                'choice_label' => function (Tarticle $tarticle) {
                    return $tarticle->getCod();
                },

            ])
            ->add('CodArt')
            ->add('libArt', TextType::class, [
                'label' => 'Libellé article',

            ])
            ->add('prxAch')
            ->add('prxVte', NumberType::class, [
                'label' => 'Prix de vente',

            ])
            ->add('prxTxe')
            ->add('prxTxs')
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
            'data_class' => Tgritarpst::class,
        ]);
    }
}
