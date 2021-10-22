<?php

namespace App\Form;

use App\Entity\Tarticle;
use App\Form\GtaGstType;
use App\Entity\Tgritarpst;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TarticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          
            ->add('tgritarpsts', CollectionType::class, [
                'entry_type' => GtaGstType::class,
                'entry_options' => [
                    'label' => false
                ],
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array([
            'data_class' => Tgritarpst::class,
            
           
        ]));
    }
   
}
