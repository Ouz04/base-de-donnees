<?php

namespace App\Form;

use App\Entity\Tpays;
use App\Entity\Tclient;
use App\Entity\Tfamcli;
use App\Entity\Tcommercial;
use App\Entity\Tsocgpe;
use App\Entity\Tsocgpt;
use App\Entity\Tsociete;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CliType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cod', TextType::class, [
                'label' => 'Code',
                'attr' => $options['attr'],

            ])
            ->add('clrCml', EntityType::class, [
                'label' => 'Commercial',
                'attr' => $options['attr'],
                'placeholder' => "Sélectionnez le code commercial",
                'class' => Tcommercial::class,
                'choice_label' => function (Tcommercial $tcommercial) {
                    return $tcommercial->getCod();
                },

            ])
            ->add('clrFamcli', EntityType::class, [
                'label' => 'Famille client',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'required' => false,
                'placeholder' => "Sélectionnez le code famille client",
                'class' => Tfamcli::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tfamcli')
                    ->where('tfamcli.xAct=true')
                    ->orderBy('tfamcli.cod');
                }
            // 'choice_label' => function (Tfamcli $tfamcli) {
            //     return $tfamcli->getCod();
            // },

            ])
            ->add('clrSoc', EntityType::class, [
                'label' => 'Societe',
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                    'disabled' => false,
                ],
                'class' => Tsociete::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tsociete')
                    ->where('tsociete.xExt=true')
                    ->Andwhere('tsociete.xAct=true')
                    ->orderBy('tsociete.cod');
                }
            // 'choice_label' => function (Tfamcli $tfamcli) {
            //     return $tfamcli->getCod();
            // },

            ])
            ->add('clrSocgpe', EntityType::class, [
                'label' => 'Groupe Societe',
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                    'disabled' => false,
                ],
                'class' => Tsocgpe::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tsocgpe')
                    ->where('tsocgpe.xAct=true')
                    ->orderBy('tsocgpe.cod');
                }
            // 'choice_label' => function (Tfamcli $tfamcli) {
            //     return $tfamcli->getCod();
            // },

             ])
            ->add('clrSocgpt', EntityType::class, [
                'label' => 'Groupement Societe',
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                    'disabled' => false,
                ],
                'class' => Tsocgpt::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tsocgpt')
                    ->where('tsocgpt.xAct=true')
                    ->orderBy('tsocgpt.cod');
                }
            // 'choice_label' => function (Tfamcli $tfamcli) {
            //     return $tfamcli->getCod();
            // },

            ])
          
        ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('cpltNom', TextType::class, [
                'label' => 'Complément nom',
                'required' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('adr', TextType::class, [
                'label' => 'Adresse',
                'required' => true,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('cpltAdr', TextType::class, [
                'label' => 'Complément adresse',
                'required' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
            ])
            ->add('lieuDit', TextType::class, [
                'label' => 'Lieu dit',
                'required' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
            ])
            ->add('cp', TextType::class, [
                'label' => 'Code postal',
                'required' => true,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],

            ])
            ->add('lclt', TextType::class, [
                'label' => 'Localité',
                'required' => true,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
            ])
            ->add('clrPys', EntityType::class, [
                'label' => 'Pays',
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
                'placeholder' => 'Sélectionnez le pays',
                'class' => Tpays::class,
                'choice_label' => function (Tpays $tpays) {
                    return $tpays->getNom();
                },
            ])
            ->add('ctc', TextType::class, [
                'label' => 'Contact',
                'required' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
            ])
            ->add('telBur', TextType::class, [
                'label' => 'Téléphone',
                'required' => false,
                'attr' => [
                    'readonly' => false,
                    'disabled' => false,
                ],
            ])
            ->add('mail', TextType::class, [
                'label' => 'Email',
                'required' => false,
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
            'data_class' => Tclient::class,
        ]);
    }
}
