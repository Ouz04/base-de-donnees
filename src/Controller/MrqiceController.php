<?php

namespace App\Controller;

use App\Form\MrqiceType;
use App\Entity\Tmrqice;
use App\Data\SearchData;

use App\Repository\TarticleRepository;
use App\Repository\TmrqiceRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MrqiceController extends AbstractController
{
    /**
     * @Route("/mrqice/creat", name="mrqice_creat")
     */
    public function mrqiceCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tmrqice = new Tmrqice;
        $tmrqice->setUsrIns($this->getUser());
        $tmrqice->setDatIns(new \DateTime('now'));

        $form = $this->createForm(MrqiceType::class, $tmrqice, ['attr' => ['readonly' => false]]);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tmrqice = $form->getData();

            $em->persist($tmrqice);
            $em->flush();
            $this->addFlash("success", "Création effectuée");
            return $this->redirectToRoute('mrqice_gst');
        }
        return $this->render('mrqice/mrqiceCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'modèle'

        ]);
    }
    /**
     * @Route("/mrqice/edit/{id}", name="mrqice_modif")
     */
    public function mrqiceModif($id, TmrqiceRepository $tmrqiceRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tmrqice = $tmrqiceRepository->findOneBy(['id' => $id]);
        $form = $this->createForm(MrqiceType::class, $tmrqice, ['attr' => ['readonly' => true]]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $product = $form->getData();

            $em->flush();
            $this->addFlash("success", "Modification effectuée");
            return $this->redirectToRoute('mrqice_gst');
        }
        return $this->render('mrqice/mrqiceCM.html.twig', [
            'formView' => $form->createView(),
            'tmrqice' => $tmrqice,
            'titre1' => 'Modification ',
            'titre2' => 'modèle'

        ]);
    }
    /**
     * @Route("/mrqice/supp/{id}", name="mrqice_supp")
     */
    public function mrqiceSupp($id, TmrqiceRepository $tmrqiceRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tmrqice = $tmrqiceRepository->findOneBy(['id' => $id]);


        if (!$tmrqice) {
            throw $this->createNotFoundException("La marque $id n'existe pas et ne peut pas être supprimée");
        }
        $tarticle = $tarticleRepository->findBy(['clrMdl' => $tmrqice->getId()]);

        if ($tarticle) {
            // dd($tartmdl);
            throw $this->createNotFoundException("La marquee $id ne peut pas être supprimée car il y a au moins un article lié");
        } else {

            $em->remove($tmrqice);
            $em->flush();
            $this->addFlash("success", "Enregistrement supprimé");

            // $data = new SearchData;
            // $form = $this->createForm(SearchFormMdl::class, $data);
            // $form->handleRequest($request);
            // $tctgiceniv = $tmodeleRepository->findSearch($data);
            return $this->redirectToRoute("mrqice_gst");
        }
    }
    /**
     * @Route("/mrqice/gestion", name="mrqice_gst")
     */
    public function mrqiceLstGst(TmrqiceRepository $tmrqiceRepository, Request $request): Response
    {
        // $data = new SearchData;
        // $form = $this->createForm(SearchFormMdl::class, $data);
        // $form->handleRequest($request);
        $tmrqice = $tmrqiceRepository->findBy([], ['cod' => 'ASC']);

        // if (!$tcotation) {
        //     throw $this->createNotFoundException("Erreur d'appel cotation X");
        // }
        return $this->render('/mrqice/mrqiceGst.html.twig', [
            'tmrqice' => $tmrqice,

        ]);
    }
}
