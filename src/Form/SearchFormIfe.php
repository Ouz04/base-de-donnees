<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Ttypitgfic;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormIfe extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('ttypitgfic', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Ttypitgfic::class,
                'choice_label' => function (Ttypitgfic $ttypitgfic) {
                    return $ttypitgfic->getDsg();
                },

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
