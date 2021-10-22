<?php

namespace App\Controller;

use App\Entity\Tartcpd;
use App\Data\SearchData;
use App\Form\SearchFormArt;
use App\Form\ArtcpdCreatType;
use App\Form\ArtcpdModifType;
use App\Repository\TartcpdRepository;
use App\Repository\TarticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtcpdController extends AbstractController
{
    /**
     * @Route("/mkt/artcpd/creat", name="artcpd_creat")
     */
    public function artcpdCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tartcpd = new Tartcpd;
        $tartcpd->setUsrIns($this->getUser());
        $tartcpd->setDatIns(new \DateTime('now'));
        $form = $this->createForm(ArtcpdCreatType::class, $tartcpd);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tartcpd = $form->getData();

            $em->persist($tartcpd);
            $em->flush();
            return $this->redirectToRoute('artcpd_gst');
        }
        // dd($tartcpd);
        return $this->render('artcpd/artcpdCreat.html.twig', [
            'formView' => $form->createView()
        ]);
    }
    /**
     * @Route("/mkt/artcpd/{id}/edit", name="artcpd_modif")
     */
    public function artcpdModif($id, TartcpdRepository $tartcpdRepository, TarticleRepository $tartaasRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tartcpd = $tartcpdRepository->findOneBy(['id' => $id]);
        $tartaas = $tartaasRepository->findOneBy(['id' => $tartcpd->getClrArtaas()]);
        $form = $this->createForm(ArtcpdModifType::class, $tartcpd);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $em->flush();

            return $this->redirectToRoute('artcpd_gst');
        }

        return $this->render('artcpd/artcpdModif.html.twig', [
            'formView' => $form->createView(),
            'tartcpd' => $tartcpd,

        ]);
    }
    /**
     * @Route("/mkt/artcpd/gestion", name="artcpd_gst")
     */
    public function artcpdListShow(TartcpdRepository $artcpdRepository, Request $request): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormArt::class, $data, ['allow_extra_fields' => '02']);
        $form->handleRequest($request);

        //$tartcpd = $artcpdRepository->findAll();
        $tartcpd = $artcpdRepository->findSearch($data);
        // if (!$tartcpd) {
        //     throw $this->createNotFoundException("Erreur d'appel article-fournisseur");
        // }
        return $this->render('/artcpd/artcpdGst.html.twig', [
            'tartcpd' => $tartcpd,
            'form' => $form->createView(),
            'allow_extra_fields' => '02'

        ]);
    }
}
