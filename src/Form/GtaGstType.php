<?php

namespace App\Form;

use App\Entity\Tgritar;
use App\Entity\Tarticle;
use App\Entity\Tgritarett;
use App\Entity\Tgritarpst;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class GtaGstType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

                ->add('codArt',TextType::class,[
                    'label' =>false,
                    'disabled' =>true,
                ])
                ->add('libArt',TextType::class,[
                    'label' =>false,
                ])
                ->add('codArtCli',TextType::class,[
                    'label' =>false,
                
                ])
                ->add('prxAch',NumberType::class,[
                    'label' =>false,           
                ])
                ->add('txMrg',NumberType::class,[
                    'label' =>false,
                    'disabled' =>true,         
                ])
                ->add('prxVte',NumberType::class,[
                    'label' =>false,           
                ])
                ->add('prxTxe',NumberType::class,[
                    'label' =>false,           
                ])
                ->add('prxTxs',NumberType::class,[
                    'label' =>false,           
                ])
                ->add('xBpu',CheckboxType::class,[
                    'label' =>false,
                ])
                ->add('xDvs',CheckboxType::class,[
                    'label' =>false,
                ])
                
            
         ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Tgritarpst::class,
        ));
    }
}
