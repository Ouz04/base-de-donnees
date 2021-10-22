<?php

namespace App\Form;

use App\Data\FichePersonnalisee;
use App\Entity\Tfamcli;
use App\Entity\Tsocgpe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class FicheArtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('carac', CheckboxType::class,[
               'label'=> 'Caractéristique',
               'required'=>false
           ])
           ->add('tarif', CheckboxType::class,[
            'label'=> 'Tarif',
            'required'=>false
            ])
           ->add('adonix', CheckboxType::class,[
                'label'=> 'Adonix',
                'required'=>false
            ])
            ->add('site', CheckboxType::class,[
                'label'=> 'Site',
                'required'=>false
            ])
            ->add('desc', CheckboxType::class,[
                'label'=> 'Description',
                'required'=>false
            ])
            ->add('enre', CheckboxType::class,[
                'label'=> 'Enregistrement',
                'required'=>false
            ])
            ->add('Envoyer', SubmitType::class)

          ;
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FichePersonnalisee::class,
        ]);
    }
}
