<?php

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

$builder
    ->add('txMrg', IntegerType::class, [
        'label' => false,
        'required' => false,
        'attr' => ['style' => 'width:60px']

    ])
    ->add('mrgExe', SubmitType::class, ['label' => 'Exécuter']);