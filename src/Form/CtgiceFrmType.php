<?php

namespace App\Form;

use App\Data\CtgiceData;
use App\Entity\Tctgiceniv;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtgiceFrmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('tctgice', EntityType::class, [
                'label' => false,
                'required' => false,
                'mapped' => false,
                'class' => Tctgiceniv::class,
                // 'attr' => [
                'placeholder' => 'Saisissez Catégorie niveau 1',
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
                'mapped' => false,
                'class' => Tctgiceniv::class,
                // 'attr' => [
                'placeholder' => 'Saisissez Catégorie niveau 2',
                // ],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tctgiceniv')
                        ->where('tctgiceniv.niv=5')
                        ->orderBy('tctgiceniv.dsg');
                }
                //     // 'expanded' => true,
                //     // 'multiple' => true
            ])
            ->add('tssctgice', EntityType::class, [
                'label' => false,
                'required' => false,
                'mapped' => false,
                'class' => Tctgiceniv::class,
                // 'attr' => [
                'placeholder' => 'Saisissez Catégorie niveau 3',
                // ],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tctgiceniv')
                        ->where('tctgiceniv.niv=5')
                        ->orderBy('tctgiceniv.dsg');
                }
                //     // 'expanded' => true,
                //     // 'multiple' => true
            ])
            ->add('tsssctgice', EntityType::class, [
                'label' => false,
                'required' => false,
                'mapped' => false,
                'class' => Tctgiceniv::class,
                // 'attr' => [
                'placeholder' => 'Saisissez Catégorie niveau 4',
                // ],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tctgiceniv')
                        ->where('tctgiceniv.niv=5')
                        ->orderBy('tctgiceniv.dsg');
                }
                //     // 'expanded' => true,
                //     // 'multiple' => true
            ]);

        $builder->get('tctgice')->addEventListener(

            //  FormEvents::POST_SUBMIT,
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {

                $idctg = $event->getData();

                $form = $event->getForm();

                if ($idctg) {
                    $this->addCtgiceniv2Field($form->getParent(), $idctg);
                }
            }
        );
    }
    private function addCtgiceniv2Field(FormInterface $form, $idctg)
    {
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'tsctgice',
            EntityType::class,
            null,
            [
                'label' => false,
                'required' => false,
                'mapped' => false,
                'class' => Tctgiceniv::class,
                'auto_initialize' => false,
                // 'attr' => [
                'placeholder' => 'Sous Catégorie',
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
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $idctg = $event->getData();
                $this->addCtgiceniv3Field($form->getParent(), $idctg);
            }
        );
        $form->add($builder->getForm());
    }


    private function addCtgiceniv3Field(FormInterface $form, $idctg)
    {
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'tssctgice',
            EntityType::class,
            null,
            [
                'label' => false,
                'required' => false,
                'mapped' => false,
                'class' => Tctgiceniv::class,
                'auto_initialize' => false,
                // 'attr' => [
                'placeholder' => 'Sous sous sous  Catégorie',
                // ],
                'query_builder' => function (EntityRepository $er) use ($idctg) {
                    //  $idctg = $event->getData();

                    $rqt = $er->createQueryBuilder('tctgiceniv')
                        ->where('tctgiceniv.niv=3')
                        ->andwhere('tctgiceniv.clrCtgiceprc= :id')
                        ->setParameter('id', $idctg)
                        ->orderBy('tctgiceniv.dsg');
                    return $rqt;
                }
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $idctg = $event->getData();
                $this->addCtgiceniv4Field($form->getParent(), $idctg);
                // $this->addCtgiceniv3Field($form->getParent(), $form->getData());
            }
        );
        $form->add($builder->getForm());
    }
    private function addCtgiceniv4Field(FormInterface $form, $idctg)
    {
        $form->add('tsssctgice', EntityType::class, [
            'class'       => EntityType::class,
            'label' => false,
            'required' => false,
            'mapped' => false,
            'class' => Tctgiceniv::class,
            'auto_initialize' => false,
            // 'attr' => [
            // 'placeholder' => 'Sous Catégorie'
            // ],
            'query_builder' => function (EntityRepository $er) use ($idctg) {
                //  $idctg = $event->getData();

                $rqt = $er->createQueryBuilder('tctgiceniv')
                    ->where('tctgiceniv.niv=4')
                    ->andwhere('tctgiceniv.clrCtgiceprc= :id')
                    ->setParameter('id', $idctg)
                    ->orderBy('tctgiceniv.dsg');
                return $rqt;
            }
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtgiceData::class,
            'csrf_protection' => false,
        ]);
    }
    public function getBlockPrefix()
    {
        // return parent::getBlockPrefix();
        return '';
    }
}
