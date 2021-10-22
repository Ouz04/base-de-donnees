<?php

namespace App\Controller;

use App\Entity\Tartfou;
use App\Data\SearchData;
use App\Form\ArtfouType;
use App\SpecClass\Reponse;
use App\Form\SearchFormArt;
use App\Repository\TartfouRepository;
use App\Repository\TarticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtfouController extends AbstractController
{
    /**
     * @Route("/mkt/artfou/creat", name="artfou_creat")
     */
    public function artfouCreat(Request $request, EntityManagerInterface $em, TarticleRepository $tarticleRepository): Response
    {
        $tartfou = new Tartfou;
        $tartfou->setUsrIns($this->getUser());
        $tartfou->setDatIns(new \DateTime('now'));
        $form = $this->createForm(ArtfouType::class, $tartfou, [
            'attr' => [
                'readonly' => false,
                'disabled' => false
            ],
        ]);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tartfou = $form->getData();
            // recherche du code article
            $idArt = $tarticleRepository->findOneBy(['cod' => $tartfou->getCodArtFrm()]);

  
            if (!$idArt) {
                // $this->addFlash("error", "Le code article " . $tartfou->getCodArtFrm() . " n'existe pas");
                throw $this->createNotFoundException("Le code article " . $tartfou->getCodArtFrm()   . " n'existe pas");
            }
            $tartfou->setClrArt($idArt);


            $em->persist($tartfou);
            $em->flush();
            return $this->redirectToRoute('artfou_gst');
        }
        return $this->render('artfou/artfouCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'article-fournisseur',
            'codFct' => '02'
        ]);
    }
    /**
     * @Route("/mkt/artfou/edit/{id}/{codFct}", name="artfou_modif")
     * codFct : code fonction : 01->création, 02->modification, 03->affichage
     */
    public function artfouModif($id, $codFct, TartfouRepository $tartfouRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tartfou = $tartfouRepository->findOneBy(['id' => $id]);
        $tartfou->setCodArtFrm($tartfou->getClrArt()->getCod());
        $form = $this->createForm(
            ArtfouType::class,
            $tartfou,
            [
                'attr' => [
                    'readonly' => true,
                ],
            ]
        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $em->flush();

            return $this->redirectToRoute('artfou_gst');
        }

        return $this->render('artfou/artfouCM.html.twig', [
            'formView' => $form->createView(),
            'tartfou' => $tartfou,
            'titre1' => 'Modification ',
            'titre2' => 'article-fournisseur',
            'codFct' => $codFct

        ]);
    }
    /**
     * @Route("/mkt/artfou/gestion", name="artfou_gst")
     */
    public function artfouLstGst(TartfouRepository $artfouRepository, Request $request): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormArt::class, $data, ['allow_extra_fields' => '03']);
        $form->handleRequest($request);
        $maxResult = 1000;

        //$tartcpd = $artcpdRepository->findAll();
        $reponse = new Reponse;
        $tartfou = $artfouRepository->findSearch($data, $maxResult, $reponse);
        $nb = count($tartfou);
        include "shared/_flashFiltre.txt";

        // if (!$tartfou) {
        //     throw $this->createNotFoundException("Erreur d'appel article-fournisseur");
        // }
        $codFct = '02';
        return $this->render('/artfou/artfouGst.html.twig', [
            'tartfou' => $tartfou,
            'form' => $form->createView(),
            'allow_extra_fields' => '03',
            'codFct' => $codFct
        ]);
    }
}
