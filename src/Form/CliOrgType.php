<?php

namespace App\Form;

use App\Entity\Tclient;
use App\Entity\TcliOrg;
use App\Entity\Torganisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CliOrgType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clrCli', EntityType::class, [
                'label' => 'Client',
                'attr' => $options['attr'],
                'placeholder' => "Sélectionnez le client",
                'class' => Tclient::class,
                'choice_label' => function (Tclient $tclient) {
                    return $tclient->getCod();
                },
            ])
            ->add('clrOrg', EntityType::class, [
                'label' => 'Organisation',
                'attr' => $options['attr'],
                'placeholder' => "Sélectionnez le code organisation",
                'class' => Torganisation::class,
                'choice_label' => function (Torganisation $torganisation) {
                    return $torganisation->getCod();
                },

            ])
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TcliOrg::class,
        ]);
    }
}
