<?php

namespace App\Form;

use App\Entity\Tdictab;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class DictabType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('dsg', TextType::class, [
                'label' => 'Désignation',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
            ])
            ->add('tabnam', TextType::class, [
                'label' => 'Auteur',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
            ])
           
            ;
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tdictab::class,
        ]);
    }
}
