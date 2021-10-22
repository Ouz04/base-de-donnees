<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Tctgiceniv;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use App\Form\EventListener\RchArtAddSctgice;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SearchFormCtgice extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('tctgice', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Tctgiceniv::class,
                // 'attr' => [
                // 'placeholder' => 'Catégorie'
                // ],
                // 'expanded' => true,
                // 'multiple' => true
            ])
            ->add('ctgiceDsg', TextType::class, [
                'label' => false,
                'required' => false,

            ])
            ->add('niv', IntegerType::class, ['label' => false, 'required' => false]);

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
