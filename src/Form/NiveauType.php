<?php

namespace App\Form;

use App\Entity\Tmrqice;
use App\Entity\Tarticle;
use App\Entity\Tctgicearb;
use App\Entity\Tctgiceniv;
use Doctrine\ORM\EntityRepository;
use PhpParser\Builder;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;

class NiveauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('clrCtgiceniv1', EntityType::class, [
                'label' => 'Niv1',
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
            ])
            ->add('clrCtgiceniv2', EntityType::class, [
                'label' => 'Niv2',
                'required' => false,
                'class' => Tctgiceniv::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tctgiceniv')
                        ->where('tctgiceniv.niv=5')
                        ->orderBy('tctgiceniv.dsg');
                }
            ])

            ->add('clrCtgiceniv3', EntityType::class, [
                'label' => 'Niv3',
                'required' => false,
                'class' => Tctgiceniv::class,
                // 'attr' => [
                // 'placeholder' => 'Catégorie'
                // ],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tctgiceniv')
                        ->where('tctgiceniv.niv=5')
                        ->orderBy('tctgiceniv.dsg');
                }
                // 'expanded' => true,
                // 'multiple' => true
            ])
            ->add('clrCtgiceniv4', EntityType::class, [
                'label' => 'Niv4',
                'required' => false,
                'class' => Tctgiceniv::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('tctgiceniv')
                        ->where('tctgiceniv.niv=5')
                        ->orderBy('tctgiceniv.dsg');
                }
            ])
        ;
            $builder->get('clrCtgiceniv1')->addEventListener(
                //  FormEvents::POST_SUBMIT,
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) {
                    $idctg = $event->getData();                  
                    $form=$event->getForm();
                    $this->addNiv2($form->getParent(),  $idctg);
                    
                 
                 
                }
            )

            ;

    }
    private function addNiv2(FormInterface $form,  $idctg){
      
       
            $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
                'clrCtgiceniv2', EntityType::class,null,
                [
                    'label' => 'Niv2',
                    'required' => false,
                    //   'mapped' => false,
                    'class' => Tctgiceniv::class,
                    'auto_initialize'=>false,
                    // 'attr' => [
                    // 'placeholder' => 'Sous Catégorie'
                    // ],
                    'query_builder' => function (EntityRepository $er) use ( $idctg) {
                        //  $idctg = $event->getData();
                        return $er->createQueryBuilder('tctgiceniv')
                            ->where('tctgiceniv.niv=2')
                            ->andwhere('tctgiceniv.clrCtgiceprc= :id')
                            ->setParameter('id',  $idctg)
                            ->orderBy('tctgiceniv.dsg');
                    }
                ]

            );
        
        
         $builder->addEventListener(
             FormEvents::POST_SUBMIT,
             function(FormEvent $event){
               
                    $form=$event->getForm();
                    $idctg = $event->getData();
                    dump($idctg);
                     $this->addNiv3($form->getParent(), $form->getData(),$idctg);
             }
            );
            $form->add($builder->getForm());
        

    }
    private function addNiv3(FormInterface $form, $idctg){
      
            $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
                'clrCtgiceniv3', EntityType::class,null,
                [
                    'label' => 'Niv3',
                    'required' => false,
                    //   'mapped' => false,
                    'class' => Tctgiceniv::class,
                    'auto_initialize'=>false,
                    // 'attr' => [
                    // 'placeholder' => 'Sous Catégorie'
                    // ],
                    'query_builder' => function (EntityRepository $er) use ($idctg) {
                        //  $idctg = $event->getData();
                        return $er->createQueryBuilder('tctgiceniv')
                            ->where('tctgiceniv.niv=3')
                            ->andwhere('tctgiceniv.clrCtgiceprc= :id')
                            ->setParameter('id',$idctg)
                            ->orderBy('tctgiceniv.dsg');
                    }
                ]

            );
           
        
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event){
              
                   $form=$event->getForm();                 
                   $idctg = $event->getData();
                   dump($idctg);
                    $this->addNiv4($form->getParent(), $form->getData(),$idctg);
            }
           );
           $form->add($builder->getForm());
        

    }
    private function addNiv4(FormInterface $form, $idctg){
       
            $form->add('clrCtgiceniv4', EntityType::class, [
                'label' => 'Niv4',
                'required' => false,
                //   'mapped' => false,
                'class' => Tctgiceniv::class,
                // 'attr' => [
                // 'placeholder' => 'Sous Catégorie'
                // ],
                'query_builder' => function (EntityRepository $er) use ($idctg) {
                    //  $idctg = $event->getData();
                    return $er->createQueryBuilder('tctgiceniv')
                        ->where('tctgiceniv.niv=4')
                        ->andwhere('tctgiceniv.clrCtgiceprc= :id')
                        ->setParameter('id', $idctg)
                        ->orderBy('tctgiceniv.dsg');
                }
            ]);
        
        

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tarticle::class,
            'method'=>'GET',
        ]);
    }
    
}
