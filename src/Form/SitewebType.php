<?php

namespace App\Form;


use App\Entity\Tsitweb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class SitewebType extends AbstractType
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
            ;
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tsitweb::class,
        ]);
    }
}
