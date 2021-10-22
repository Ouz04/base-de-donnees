<?php

namespace App\Form;

use App\Entity\Tpays;
use App\Entity\Tclient;
use App\Entity\Tcommercial;
use App\Entity\Torganisation;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrgType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cod', TextType::class, [
                'label' => 'Code',

            ])
            ->add('clrCml', EntityType::class, [
                'label' => 'Commercial',
                'attr' => ['readonly' => false],
                'placeholder' => "Sélectionnez le code commercial",
                'class' => Tcommercial::class,
                'choice_label' => function (Tcommercial $tcommercial) {
                    return $tcommercial->getCod();
                },

            ])
            // ->add('rso', TextType::class, [
            // 'label' => 'Raison sociale',
            // 'attr' => ['readonly' => false],
            // 'required' => true,
            // ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => ['readonly' => false],
            ])
            ->add('cpltNom', TextType::class, [
                'label' => 'Complément nom',
                'required' => false,
                'attr' => ['readonly' => false],
            ])
            ->add('adr', TextType::class, [
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
            ])

                ->add('clrCli', EntityType::class, [
                    'label' => 'Code client',
                    'attr' => $options['attr'],
                    'placeholder' => 'Sélectionnez le code client',
                    'attr' => ['readonly' => false],
                    'class' => Tclient::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('tclient')
                            ->where('tclient.xAct=true')
                            ->orderBy('tclient.cod');
                    // 'choice_label' => function (Tclient $tclient) {
                    //     return $tclient->getCod();
                    }
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
            'data_class' => Torganisation::class,
        ]);
    }
}
