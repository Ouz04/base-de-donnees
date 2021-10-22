<?php

namespace App\Form;

use App\Entity\ArticleRechercheb;
use App\Entity\Tcategorie;
use App\Entity\Tconstructeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArtRchbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('artCod', TextType::class, [
                'attr' => [
                    'placeholder' => 'Code article'
                ],
                'label' => 'Code article',
                'required' =>  false,
            ])
            ->add('clrCtg', EntityType::class, [
                'label' => 'Catégorie',
                'class' => Tcategorie::class,
                'choice_label' => function (Tcategorie $tcategorie) {
                    return $tcategorie->getDsg();
                },
                // 'choice_attr' => ChoiceList::attr($this, function (?Tcategorie $tcategory
                // return $tcategory->getDsg();
                // }),
                // 'label' => false,
                'required' =>  false,
            ])
            ->add('clrCtr', EntityType::class, [
                'label' => 'Marque',
                'class' => Tconstructeur::class,
                'choice_label' => function (Tconstructeur $tconstructeur) {
                    return $tconstructeur->getNom();
                },
                'attr' => [
                    'placeholder' => 'Marque'
                ],
                // 'label' => true,
                'required' =>  false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleRechercheb::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
