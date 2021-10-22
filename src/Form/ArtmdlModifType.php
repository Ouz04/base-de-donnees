<?php

namespace App\Form;

use App\Entity\Tuser;
use App\Entity\Tartmdl;
use App\Entity\Tmodele;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArtmdlModifType extends AbstractType
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
            ->add('clrMdl', EntityType::class, [
                'label' => 'Modèle',
                'attr' => [
                    'placeholder' => 'Sélectionnez le code cotation',
                    'readonly' => true
                ],
                'class' => Tmodele::class,
                'choice_label' => function (Tmodele $tmodele) {
                    return $tmodele->getCod();
                }
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
            'data_class' => Tartmdl::class,
        ]);
    }
}
