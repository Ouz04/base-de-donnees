<?php

namespace App\Form;

use App\Entity\Tpays;
use App\Entity\Tbpartner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomRue', TextType::class, [
                'label' => 'Adresse',
                'required' => true,
                'attr' => ['readonly' => false],
            ])
            ->add('cpltAdr', TextType::class, [
                'label' => 'Complément adresse',
                'required' => false,
                'attr' => ['readonly' => false],
            ])
            ->add('lieuDit', TextType::class, [
                'label' => 'Lieu dit',
                'required' => false,
                'attr' => ['readonly' => false],
            ])
            ->add('cp', TextType::class, [
                'label' => 'Code postal',
                'required' => true,
                'attr' => ['readonly' => false],

            ])
            ->add('lclt', TextType::class, [
                'label' => 'Localité',
                'required' => true,
                'attr' => ['readonly' => false],
            ])
            ->add('clrPys', EntityType::class, [
                'label' => 'Pays',
                'attr' => ['readonly' => false],
                'placeholder' => 'Sélectionnez le pays',
                'class' => Tpays::class,
                'choice_label' => function (Tpays $tpays) {
                    return $tpays->getNom();
                },
            ])
            ->add('ctc', TextType::class, [
                'label' => 'Contact',
                'required' => false,
                'attr' => ['readonly' => false],
            ])
            ->add('telBur', TextType::class, [
                'label' => 'Téléphone',
                'required' => false,
                'attr' => ['readonly' => false],
            ])
            ->add('mail', TextType::class, [
                'label' => 'Email',
                'required' => false,
                'attr' => ['readonly' => false],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tbpartner::class,
        ]);
    }
}
