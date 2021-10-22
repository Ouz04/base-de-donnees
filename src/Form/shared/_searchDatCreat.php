<?php

use App\Entity\Tuser;
use App\Entity\Tservice;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

$builder
    ->add('sigDat', ChoiceType::class, [
        'label' => false,
        'required' => false,
        'choices' => [
            '<' => '<',
            '<=' => '<=',
            '=' => '=',
            '>' => '>',
            '>=' => '>=',
        ],
        'attr' => ['style' => 'width:60px']

    ])
    ->add('datIns', DateType::class, [
        'label' => false,
        'required' => false,
        'widget' => 'single_text',
    ])
    ->add('usrInsEmail', EntityType::class, [
        'label' => false,
        'required' => false,
        'class' => Tuser::class,
        'query_builder' => function (EntityRepository $tuser) {
            return $tuser->createQueryBuilder('tuser')
                ->orderBy('tuser.nom');
        }
    ])
    ->add('srvDsg', EntityType::class, [
        'label' => false,
        'required' => false,
        'class' => Tservice::class,
        'query_builder' => function (EntityRepository $tservice) {
            return $tservice->createQueryBuilder('tservice')
                ->orderBy('tservice.dsg');
        }
    ]);;
