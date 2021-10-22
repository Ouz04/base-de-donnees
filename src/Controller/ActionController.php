<?php

namespace App\Controller;

use App\Repository\TactionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActionController extends AbstractController
{
    /**
     * @Route("/gestion/{type}", name="action_show")
     * @IsGranted("ROLE_USER", message="Vous devez être connecté pour naviguer") 
     */
    public function show($type, TactionRepository $tactionRepository): Response
    {
        $taction = $tactionRepository->findBy([
            'typ' => $type
        ], [
            'rngAff' => 'ASC'
        ]);
        // findAll()
        return $this->render('action/show.html.twig', [
            'taction' =>  $taction,
        ]);
    }
}
