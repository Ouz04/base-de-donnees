<?php

namespace App\Form;

use App\Entity\Tarticle;
use App\Entity\Tgritarett;
use App\Entity\Tgritarpst;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class GtapstCMType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codCliFrm', TextType::class, [
                'label' => 'Code client',
                'required' => true,
            ])
            ->add('clrGta', EntityType::class, [
                'label' => 'Code grille tarifaire',
                'class' => Tgritarett::class,
                'choice_label' => function (Tgritarett $tgritarett) {
                    return $tgritarett->getCod();
                }
            ])
            ->add('codArtFrm', TextType::class, [
                'label' => 'Code article',
                'required' => true,
            ])
            ->add('libArt', TextType::class, [
                'label' => 'Libellé',
                'attr' => ['readonly' => false],
                'required' => true,

            ])
            ->add('CodArtCli', TextType::class, [
                'label' => 'Code article client',
                'attr' => ['readonly' => false],
                'required' => false,

            ])
            ->add('prxAch', NumberType::class, [
                'label' => 'Prix achat',
                'attr' => ['readonly' => true],
                'required' => false,

            ])
            ->add('prxAch', NumberType::class, [
                'label' => 'Prix achat',
                'attr' => ['readonly' => false],
                'required' => false,

            ])
            ->add('prxVte', NumberType::class, [
                'label' => 'Prix de vente',
                'attr' => ['readonly' => false],
                'required' => false,

            ])
            ->add('prxTxe', NumberType::class, [
                'label' => 'Taxe éco',
                'attr' => ['readonly' => false],
                'required' => false,

            ])
            ->add('prxTxs', NumberType::class, [
                'label' => 'Taxe sorecop',
                'attr' => ['readonly' => false],
                'required' => false,

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tgritarpst::class,
        ]);
    }
}
