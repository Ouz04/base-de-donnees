<?php

namespace App\Controller;

use App\Entity\Tartcot;
use App\Form\ArtcotCreatType;
use App\Form\ArtcotModifType;
use App\Repository\TartcotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtcotController extends AbstractController
{
    /**
     * @Route("/mkt/artcot/creat", name="artcot_creat")
     */
    public function artcotCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tartcot = new Tartcot;
        $tartcot->setUsrIns($this->getUser());
        $tartcot->setDatIns(new \DateTime('now'));
        $form = $this->createForm(ArtcotCreatType::class, $tartcot);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tartcot = $form->getData();

            $em->persist($tartcot);
            $em->flush();
            return $this->redirectToRoute('artcot_gst');
        }
        return $this->render('artcot/artcotCreat.html.twig', [
            'formView' => $form->createView()
        ]);
    }
    /**
     * @Route("/mkt/artcot/{id}/edit", name="artcot_modif")
     */
    public function artcotModif($id, TartcotRepository $tartcotRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tartcot = $tartcotRepository->findOneBy(['id' => $id]);
        $tartcot->setUsrUpd($this->getUser());
        $tartcot->setDatUpd(new \DateTime('now'));
        $form = $this->createForm(ArtcotModifType::class, $tartcot);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $em->flush();

            return $this->redirectToRoute('artcot_gst');
        }
        return $this->render('artcot/artcotModif.html.twig', [
            'formView' => $form->createView(),
            'tartcot' => $tartcot
        ]);
    }
    /**
     * @Route("/mkt/artcot/gestion", name="artcot_gst")
     */
    public function artcotListShow(TartcotRepository $artcotRepository): Response
    {
        $tartcot = $artcotRepository->findAll();

        // if (!$tartcot) {
        //     throw $this->createNotFoundException("Erreur d'appel article-cotation");
        // }
        return $this->render('/artcot/artcotGst.html.twig', [
            'tartcot' => $tartcot,

        ]);
    }
}
