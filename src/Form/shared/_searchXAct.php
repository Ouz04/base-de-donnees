<?php

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


$builder
    ->add('xAct', ChoiceType::class, [
        'label' => false,
        'required' => false,
        'choices' => [
            'oui' => 1,
            'non' => 0,
        ],
        'attr' => ['style' => 'width:100px']

    ]);
