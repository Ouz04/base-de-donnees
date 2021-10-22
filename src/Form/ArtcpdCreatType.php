<?php

namespace App\Form;

use App\Entity\Tartcpd;
use App\Entity\Ttypcpd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ArtcpdCreatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clrArtaas', TextType::class, [
                'label' => 'Code article',

            ])
            ->add('clrTypcpd', EntityType::class, [
                'class' => Ttypcpd::class,
                'choice_label' => function (Ttypcpd $ttypdcpd) {
                    return $ttypdcpd->getDsg();
                },
            ])
            ->add('clrArtase', TextType::class, [
                'label' => 'Code article',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tartcpd::class,
        ]);
    }
}
