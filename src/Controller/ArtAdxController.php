<?php

namespace App\Controller;

use App\Repository\TartAdxRepository;
use App\Repository\TartfouRepository;
use App\Repository\TartmdlRepository;
use App\Repository\TarticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtAdxController extends AbstractController
{
    /**
     * @Route("/ach/art/adx", name="art_adx")
     */
    public function index(TartfouRepository $tartfouRepository, TarticleRepository $tarticleRepository): Response
    {
        $tartfou = $tartfouRepository->findSearchTest(100);

        return $this->render('art_adx/index.html.twig', [
            'tartfou' => $tartfou,
        ]);
    }
    /**
     * @Route("/ach/art/adx", name="artadx_pnr")
     */
    public function artAdx(TartfouRepository $tartfouRepository, TarticleRepository $tarticleRepository): Response
    {
        $tartfou = $tartfouRepository->findSearchTest(100);

        return $this->render('art_adx/index.html.twig', [
            'tartfou' => $tartfou,
        ]);
    }
}
