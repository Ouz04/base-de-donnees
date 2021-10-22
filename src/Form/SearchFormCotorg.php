<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Tcotation;
use App\Entity\Torganisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchFormCotorg extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('torganisation', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Torganisation::class,

            ])
            ->add('orgCod', TextType::class, [
                'label' => false,
                'required' => false,

            ])
            ->add('tcotation', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Tcotation::class,

            ])
            ->add('cotCod', TextType::class, [
                'label' => false,
                'required' => false,

            ]);
        include("shared/_searchDatCreat.php");
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,

        ]);
    }

    public function getBlockPrefix()
    {
        // return parent::getBlockPrefix();
        return '';
    }
}
