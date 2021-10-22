<?php

namespace App\Form;

use App\Entity\Tsocgpe;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class SocgpeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cod', TextType::class, [
                'label' => 'Code',
                'attr' => $options['attr'],

            ])
            ->add('dsg', TextType::class, [
                'label' => 'Désignation',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
            ])
            ->add('xAct', ChoiceType::class, [
                'label' => 'Actif',
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                    'disabled' => false,
                ],
                'choices' => ['Oui' => true, 'Non' => false]

            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tsocgpe::class,
        ]);
    }
}
