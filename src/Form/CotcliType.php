<?php

namespace App\Form;

use App\Entity\Tclient;
use App\Entity\Tcotcli;
use App\Entity\Tcotation;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CotcliType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clrCot', EntityType::class, [
                'label' => 'Code cotation',
                'attr' => $options['attr'],
                'placeholder' => 'Sélectionnez le code cotation',
                'class' => Tcotation::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tcotation')
                        ->where('tcotation.xAct=true')
                        ->orderBy('tcotation.cod');
                // 'choice_label' => function (Tcotation $tcotation) {
                //     return $tcotation->getCod();
                // },
                }
            ])
            ->add('clrCli', EntityType::class, [
                'label' => 'Code client',
                'attr' => $options['attr'],
                'placeholder' => 'Sélectionnez le code client',
                'class' => Tclient::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tclient')
                        ->where('tclient.xAct=true')
                        ->orderBy('tclient.cod');
                // 'choice_label' => function (Tclient $tclient) {
                //     return $tclient->getCod();
                }
            ])
            ->add('datDeb', DateType::class, [
                'label' => 'Date de fin',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'widget' => 'single_text',
            ])
            ->add('datFin', DateType::class, [
                'label' => 'Date de début',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'widget' => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tcotcli::class,
        ]);
    }
}
