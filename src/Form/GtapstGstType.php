<?php

namespace App\Form;

use App\Entity\Tartfou;
use App\Entity\Tgritarpst;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class GtapstGstType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('id', TextType::class, [
            //     'label' => false,
            //     'attr' => ['readonly' => true],
            // ])
            ->add('codArt', TextType::class, [
                'label' => false,
                'disabled' => true,
            ])
            ->add('libArt', TextType::class, [
                'label' => false,
            ])
            ->add('codArtCli', TextType::class, [
                'label' => false,
                'required' => false,

            ])
            ->add('prxAch', NumberType::class, [
                'label' => false,
                'attr' => ['readonly' => true],
            ])
            // ->add('clrArtfou',EntityType::class,[
            //     'label' =>false,
            //     'attr' => ['readonly' => true], 
            //     'class' => Tartfou::class,        
            // ])
            // ->add('txMrg', NumberType::class, [
            //     'label' => false,
            //     'attr' => [
            //         'readonly' => true,
            //     ]

            // ])
            ->add('prxVte', NumberType::class, [
                'label' => false,
            ])
            ->add('prxTxe', NumberType::class, [
                'label' => false,
            ])
            ->add('prxTxs', NumberType::class, [
                'label' => false,
            ])
            ->add('xBpu', CheckboxType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('xDvs', CheckboxType::class, [
                'label' => false,
                'required' => false,
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tgritarpst::class,
        ]);
    }
}
