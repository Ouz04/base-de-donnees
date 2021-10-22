<?php

namespace App\Controller;

use App\Repository\TarticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add/{id}", name="cart_add",  requirements={"id":"\d+"}) 
     */
    public function add($id,  TarticleRepository $tarticleRepository, SessionInterface $session)
    {
        // seccurisation est-ce que le produit existe
        $article = $tarticleRepository->find($id);
        if (!$article) {
            throw $this->createNotFoundException("Ce produit $id n'existe pas");
        }
        // securisation : est-ce que le produit existe ?

        // dd($request->getSession()->get());
        $cart = $session->get('cart', []);
        // retrouver le panier dans la session

        // s'il n'existe pas créer un tableau vide

        // voir si le produit existe déjà
        // si c'est le cas , augmenter la quantité
        if (array_key_exists($id, $cart)) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }


        // sinon ajouter le produit avec quantité 1

        // enregister le tableau mis à jour dans la session
        $session->set('cart', $cart);
        //$session->remove('cart');
        // dd($request->getSession()->get('cart'));
        /**
         * @var FlashBag
         */


        $this->addFlash('success', "Le produit a bien été ajouté au panier");
        //$flashBag->add('success', "Le produit a bien été ajouté au panier");
        // $flashBag->add('info', "Une petite information");
        // $flashBag->add('warning', "Attention");
        // $flashBag->add('success', "Un autre succès");
        //dd($flashBag);
        return $this->redirectToRoute(
            'product_listCategory',
            []
        );
    }
    /**
     * @Route("/cart", name="cart_show")
     */
    public function show(SessionInterface $session, TarticleRepository $tarticleRepository)
    {
        $detailedCart = [];
        $total = 0;
        foreach ($session->get('cart', []) as $id => $qty) {
            $article = $tarticleRepository->find($id);
            $detailedCart[] = [
                'article' => $article,

            ];
            // $total += ($product->getPrice() * $qty);
        }
        // dd($detailedCart);
        return $this->render('cart/index.html.twig', [
            'items' => $detailedCart,


        ]);
    }
}
