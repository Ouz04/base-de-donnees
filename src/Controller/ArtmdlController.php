<?php

namespace App\Controller;

use App\Entity\Tartmdl;
use App\Data\SearchData;
use App\Form\SearchFormArt;
use App\Form\ArtmdlCreatType;
use App\Form\ArtmdlModifType;
use App\Repository\TartmdlRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtmdlController extends AbstractController
{
    /**
     * @Route("/mkt/artmdl/creat", name="artmdl_creat")
     */
    public function artmdlCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tartmdl = new Tartmdl;
        $tartmdl->setUsrIns($this->getUser());
        $tartmdl->setDatIns(new \DateTime('now'));
        $form = $this->createForm(ArtmdlCreatType::class, $tartmdl, [
            'attr' => [
                'readonly' => false,
                'disabled' => false
            ],
        ]);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tartmdl = $form->getData();

            $em->persist($tartmdl);
            $em->flush();
            return $this->redirectToRoute('artmdl_gst');
        }
        return $this->render('artmdl/artmdlCreat.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'article-modèle'

        ]);
    }
    /**
     * @Route("/mkt/artmdl/{id}/edit", name="artmdl_modif")
     */
    public function artmdlModif($id, TartmdlRepository $tartmdlRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tartmdl = $tartmdlRepository->findOneBy(['id' => $id]);
        $form = $this->createForm(ArtmdlModifType::class, $tartmdl, [
            'attr' => [
                'readonly' => true,
                'disabled' => true
            ],
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $em->flush();

            return $this->redirectToRoute('artmdl_gst');
        }
        return $this->render('artmdl/artmdlModif.html.twig', [
            'formView' => $form->createView(),
            'tartmdl' => $tartmdl,
            'titre1' => 'Modification ',
            'titre2' => 'article-modèle'

        ]);
    }
    /**
     * @Route("/mkt/artmdl/gestion", name="artmdl_gst")
     */
    public function artmdlListShow(TartmdlRepository $tartmdlRepository, Request $request): Response
    {

        $data = new SearchData;
        $form = $this->createForm(SearchFormArt::class, $data, ['allow_extra_fields' => '01']);
        $form->handleRequest($request);

        $tartmdl = $tartmdlRepository->findSearch($data);

        return $this->render('/artmdl/artmdlGst.html.twig', [
            'tartmdl' => $tartmdl,
            'form' => $form->createView(),
            'allow_extra_fields' => '01'

        ]);
    }
}
