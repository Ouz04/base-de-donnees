<?php

namespace App\Form;

use App\Entity\Tdictionnaire;
use App\Entity\Tsociete;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class DictionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cod', TextType::class, [
                'label' => 'Code',
                'attr' => $options['attr'],

            ])
            ->add('lib', TextType::class, [
                'label' => 'Libellé',
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
            'data_class' => Tdictionnaire::class,
        ]);
    }
}
