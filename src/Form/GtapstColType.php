<?php

namespace App\Form;


use App\Entity\Tgritarcol;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class GtapstColType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tgritarpsts', CollectionType::class, [
                'entry_type' => GtapstGstType::class,
                'entry_options' => ['label' => false],
                'by_reference' => false,
                // this allows the creation of new forms and the prototype too
                'allow_add' => true,
                // self explanatory, this one allows the form to be removed
                'allow_delete' => true
            ])
            // just a regular save button to persist the changes
            ->add('Enregistrer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-primary pull-right'
                ]
            ])

       
            // ->add('prxAch')
            // ->add('prxVte')
            // ->add('prxTxe')
            // ->add('prxTxs')
            // ->add('codArt')
            // ->add('codCot')
            // ->add('xBpu')
            // ->add('xDvs')
            // ->add('cmt')
            // ->add('codArtCli')
            // ->add('txMrg')
            // ->add('clrArt');
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tgritarcol::class,
        ]);
    }
}
