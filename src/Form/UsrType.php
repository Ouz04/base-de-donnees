<?php

namespace App\Form;

use App\Entity\Tuser;
use App\Entity\Tservice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsrType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotBlank(['message' => 'Merci de saisir une adresse email'])
                ],
                'attr' => [
                    'placeholder' => 'Adresse email de connexion'
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Marketing' => 'ROLE_MKT',
                    'Acheteur' => 'ROLE_ACH',
                    'Commercial' => 'ROLE_CML',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Exploitant' => 'ROLE_EXP'
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Roles',
                'attr' => [
                    'readonly' => false
                ]
            ])
            ->add('plainPassword', TextType::class, [
                'label' => 'Nouveau mot de passe',
                'attr' => [
                    'readonly' => false,
                    'required' => false,
                ],
                'required' => false,
            ])
            // ->add('password', TextType::class, [
            //     'label' => 'Mot de passe encodé',
            //     'attr' => [
            //         'readonly' => true
            //     ]
            // ])
            ->add('clrSrv', EntityType::class, [
                'label' => 'Service',
                'placeholder' => '',
                'attr' => [
                    'readonly' => false
                ],
                'class' => Tservice::class,
                'choice_label' => function (Tservice $tservice) {
                    return $tservice->getDsg();
                },
                'required' => true,
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'readonly' => false
            ],
            'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tuser::class,
        ]);
    }
}
