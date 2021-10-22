<?php

namespace App\Form;

use App\Entity\Tarticle;
use App\Entity\Tctgicearb;
use App\Entity\Tctgiceniv;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CtgicearbType extends AbstractType
{
    private $vReadonly;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['action'] == '02') {
            $vReadonly = true;
        } else {
            $vReadonly = false;
        }
        $builder
            ->add('idIce', TextType::class, [
                'label' => 'Code Icecat',
            ])
            ->add('clrNiv1', EntityType::class, [
                'label' => 'Catégorie niveau 1',
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                ],
                'placeholder' => '',
                'class' => Tctgiceniv::class,
                'required' => false,
                'choice_label' => function (Tctgiceniv $tctgiceniv) {
                    return $tctgiceniv->getDsg();
                }
            ])
            ->add('clrNiv2', EntityType::class, [
                'label' => 'Catégorie niveau 2',
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                ],
                'placeholder' => '',
                'class' => Tctgiceniv::class,
                'required' => false,
                'choice_label' => function (Tctgiceniv $tctgiceniv) {
                    return $tctgiceniv->getDsg();
                }
            ])
            ->add('clrNiv3', EntityType::class, [
                'label' => 'Catégorie niveau 3',
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                ],
                'placeholder' => '',
                'class' => Tctgiceniv::class,
                'required' => false,
                'choice_label' => function (Tctgiceniv $tctgiceniv) {
                    return $tctgiceniv->getDsg();
                }
            ])
            ->add('clrNiv4', EntityType::class, [
                'label' => 'Catégorie niveau 4',
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                ],
                'placeholder' => '',
                'class' => Tctgiceniv::class,
                'required' => false,
                'choice_label' => function (Tctgiceniv $tctgiceniv) {
                    return $tctgiceniv->getDsg();
                }
            ])
            ->add('nbreActicles', EntityType::class, [
                'label' => 'Catégorie niveau 4',
                'mapped'=> false,
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                ],
                'placeholder' => '',
                'class' => Tarticle::class,
                'required' => false,
                'choice_label' => function (Tarticle $tarticle) {
                    return $tarticle->getClrCtgice();
                }
            ])
            
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tctgicearb::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
