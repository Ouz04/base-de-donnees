<?php

namespace App\Form;

use App\Entity\Tcotorg;
use App\Entity\Tfamcli;
use App\Entity\Tcotation;
use App\Entity\Tcotfamcli;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CotfamcliType extends AbstractType
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
            ->add('clrfamcli', EntityType::class, [
                'label' => 'Code organisation',
                'attr' => $options['attr'],
                'placeholder' => 'Sélectionnez le code organisation',
                'class' => Tfamcli::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tfamcli')
                        ->where('tfamcli.xAct=true')
                        ->orderBy('tfamcli.cod');
                // 'choice_label' => function (Tcotation $tcotation) {
                //     return $tcotation->getCod();
                // },
                }
            ])
            // ->add('datDeb', DateType::class, [
            //     'label' => 'Date de fin',
            //     'attr' => [
            //         'readonly' => false,
            //         'disabled' => false,
            //     ],
            //     'widget' => 'single_text',
            // ])
            // ->add('datFin', DateType::class, [
            //     'label' => 'Date de début',
            //     'attr' => [
            //         'readonly' => false,
            //         'disabled' => false,
            //     ],
            //     'widget' => 'single_text',
            // ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tcotfamcli::class,
        ]);
    }
}
