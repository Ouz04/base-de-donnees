<?php

namespace App\Form;

use App\Entity\Tfournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FouType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cod', TextType::class, [
                'label' => 'Code'
            ])
            ->add('rso', TextType::class, [
                'label' => 'Nom',
                'attr' => ['readonly' => false],
                'required' => true,
            ])
            ->add('codAdx', TextType::class, [
                'label' => 'Code Adonix',
                'attr' => ['readonly' => false],
                'required' => true,
            ])
            ->add('xAct', ChoiceType::class, [
                'label' => 'Actif',
                'attr' => [
                    'readonly' => false,
                    'required' => false
                ],
                'choices' => ['Oui' => true, 'Non' => false]

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tfournisseur::class,
        ]);
    }
}
