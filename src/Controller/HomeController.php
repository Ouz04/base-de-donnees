<?php

namespace App\Controller;

use App\Entity\Tarticle;
use App\Repository\TarticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="homepage")
     */
    public function homepage(TarticleRepository $tarticleRepository)
    {
        $tarticles = $tarticleRepository->findBy([], [], 3);
        // dd($products);

        // $productRepository = $em->getRepository(Product::class);

        // $product = $productRepository->find(5);
        // $em->remove($product);
        // $em->flush();
        // // dd($product);

        return $this->render('home.html.twig', ['products' => $tarticles]);
    }
}
