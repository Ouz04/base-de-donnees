<?php

namespace App\Form;

use App\Entity\Tmodele;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArtmdlCreatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clrArt', TextType::class, [
                'label' => 'Code article',

            ])
            ->add('clrMdl', EntityType::class, [
                'label' => 'Modèle',
                'class' => Tmodele::class,
                'mapped' => false,
                'choice_label' => function (Tmodele $tmodele) {
                    return $tmodele->getCod();
                },

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
