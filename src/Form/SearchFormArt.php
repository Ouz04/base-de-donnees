<?php

namespace App\Form;

use App\Entity\Tmrqice;
use App\Entity\Ttypcpd;
use App\Data\SearchData;
use App\Entity\Tcategorie;
use App\Entity\Tctgicearb;
use App\Entity\Tctgiceniv;
use App\Entity\Tfournisseur;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use App\Form\EventListener\RchArtAddSctgice;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class SearchFormArt extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder
        // ->add('saveAndAdd', SubmitType::class, ['label' => 'Appliquer la marge']);
        
        if ($options['allow_extra_fields'] === '02') {
            $builder
            
                ->add('ttypcpd', EntityType::class, [
                    'label' => false,
                    'required' => false,
                    'class' => Ttypcpd::class,
                    'choice_label' => function (Ttypcpd $ttypcpd) {
                        return $ttypcpd->getDsg();
                    },
                ]);
        }
        if ($options['allow_extra_fields'] === '03') {
            $builder
                ->add('tfournisseur', EntityType::class, [
                    'label' => false,
                    'required' => false,
                    'class' => Tfournisseur::class,
                    'choice_label' => function (Tfournisseur $tfournisseur) {
                        return $tfournisseur->getRso();
                    },
                ]);
        }


        $builder
            ->add('codArt', TextType::class, [
                'label' => false,
                'required' => false,
                // 'attr' => [
                // 'placeholder' => 'Code article'
                // ],
            ])
            ->add('refCtr', TextType::class, [
                'label' => false,
                'required' => false,
                // 'attr' => [
                // 'placeholder' => 'Code article'
                // ],
            ]);
        if ($options['allow_extra_fields'] == '01' or $options['allow_extra_fields'] == '02' or $options['allow_extra_fields'] == '03' or $options['allow_extra_fields'] == '04' or $options['allow_extra_fields'] == '05') {
            $builder
                ->add('lib', TextType::class, [
                    'label' => false,
                    'required' => false,
                    // 'attr' => [
                    // 'placeholder' => 'Libellé'
                    // ],
                ])
                ->add('tmrqice', EntityType::class, [
                    'label' => false,
                    'required' => false,
                    'class' => Tmrqice::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('tmrqice')
                            ->orderBy('tmrqice.nom');
                    }
                ])
                ->add('tctgice', EntityType::class, [
                    'label' => false,
                    'required' => false,
                    'class' => Tctgiceniv::class,
                    // 'attr' => [
                    // 'placeholder' => 'Catégorie'
                    // ],
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('tctgiceniv')
                            ->where('tctgiceniv.niv=1')
                            ->orderBy('tctgiceniv.dsg');
                    }
                    // 'expanded' => true,
                    // 'multiple' => true
                ])
                ->add('tsctgice', EntityType::class, [
                    'label' => false,
                    'required' => false,
                    'class' => Tctgiceniv::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('tctgiceniv')
                            ->where('tctgiceniv.niv=5')
                            ->orderBy('tctgiceniv.dsg');
                    }
                ]);
            $builder->get('tctgice')->addEventListener(

                //  FormEvents::POST_SUBMIT,
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) {

                    $idctg = $event->getData();

                    $form = $event->getForm();

                    if ($idctg) {
                        // dump($event);
                        $form->getParent()->add('tsctgice', EntityType::class, [
                            'label' => false,
                            'required' => false,
                            //   'mapped' => false,
                            'class' => Tctgiceniv::class,
                            // 'attr' => [
                            // 'placeholder' => 'Sous Catégorie'
                            // ],
                            'query_builder' => function (EntityRepository $er) use ($idctg) {
                                //  $idctg = $event->getData();

                                $rqt = $er->createQueryBuilder('tctgiceniv')
                                    ->where('tctgiceniv.niv=2')
                                    ->andwhere('tctgiceniv.clrCtgiceprc= :id')
                                    ->setParameter('id', $idctg)
                                    ->orderBy('tctgiceniv.dsg');
                                return $rqt;
                            }
                        ]);
                    }
                }
            );
        }

        //  dd($options);

        if ($options['allow_extra_fields'] == '01' or  $options['allow_extra_fields'] == '03') {

            include("shared/_searchXAct.php");
            include("shared/_searchDatCreat.php");
        }
        if ($options['allow_extra_fields'] == '05' ) {
            include("shared/_searchTxMrg.php");
        }
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
