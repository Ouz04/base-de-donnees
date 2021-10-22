<?php

namespace App\Form;

use App\Entity\Tuser;
use App\Entity\Tartcpd;
use App\Entity\Ttypcpd;
use App\Entity\Tarticle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArtcpdModifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('clrArtaas', TextType::class, [
                'label' => 'Code article',
                'attr' => array(
                    'readonly' => true,
                ),

            ])
            ->add('clrTypcpd', EntityType::class, [
                'class' => Ttypcpd::class,
                'choice_label' => function (Ttypcpd $ttypdcpd) {
                    return $ttypdcpd->getDsg();
                },
                'attr' => array(
                    'readonly' => true,
                ),
            ])
            ->add('clrArtase', TextType::class, [
                'label' => 'Code article',
                'attr' => array(
                    'readonly' => true,
                ),

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tartcpd::class,
        ]);
    }
}
