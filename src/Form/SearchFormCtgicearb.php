<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Tctgiceniv;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;



class SearchFormCtgicearb extends AbstractType
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
