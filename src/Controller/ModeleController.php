<?php

namespace App\Controller;

use App\Form\MdlType;
use App\Entity\Tmodele;
use App\Data\SearchData;

use App\Form\SearchFormMdl;
use App\Repository\TartmdlRepository;
use App\Repository\TmodeleRepository;
use App\Repository\TarticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModeleController extends AbstractController
{
    /**
     * @Route("/modele/creat", name="mdl_creat")
     */
    public function modeleCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tmodele = new Tmodele;
        $tmodele->setUsrIns($this->getUser());
        $tmodele->setDatIns(new \DateTime('now'));

        $form = $this->createForm(MdlType::class, $tmodele, ['attr' => ['readonly' => false]]);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tmodele = $form->getData();

            $em->persist($tmodele);
            $em->flush();
            $this->addFlash("success", "Création effectuée");
            return $this->redirectToRoute('mdl_gst');
        }
        return $this->render('modele/mdlCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'modèle'

        ]);
    }
    /**
     * @Route("/modele/edit/{id}", name="mdl_modif")
     */
    public function modeleModif($id, TmodeleRepository $tmodeleRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tmodele = $tmodeleRepository->findOneBy(['id' => $id]);
        $form = $this->createForm(MdlType::class, $tmodele, ['attr' => ['readonly' => true]]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $product = $form->getData();

            $em->flush();
            $this->addFlash("success", "Modification effectuée");
            return $this->redirectToRoute('mdl_gst');
        }
        return $this->render('modele/mdlCM.html.twig', [
            'formView' => $form->createView(),
            'tmodele' => $tmodele,
            'titre1' => 'Modification ',
            'titre2' => 'modèle'

        ]);
    }
    /**
     * @Route("/modele/supp/{id}", name="mdl_supp")
     */
    public function modeleSupp($id, TmodeleRepository $tmodeleRepository, TartmdlRepository $tartmdlRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tmodele = $tmodeleRepository->findOneBy(['id' => $id]);


        if (!$tmodele) {
            throw $this->createNotFoundException("La catégorie $id n'existe pas et ne peut pas être supprimée");
        }
        $tartmdl = $tartmdlRepository->findBy(['clrMdl' => $tmodele->getId()]);

        if ($tartmdl) {
            // dd($tartmdl);
            throw $this->createNotFoundException("Le modèle $id ne peut pas être supprimé car il y a au moins un article lié");
        } else {

            $em->remove($tmodele);
            $em->flush();
            $this->addFlash("success", "Enregistrement supprimé");

            // $data = new SearchData;
            // $form = $this->createForm(SearchFormMdl::class, $data);
            // $form->handleRequest($request);
            // $tctgiceniv = $tmodeleRepository->findSearch($data);
            return $this->redirectToRoute("mdl_gst");
        }
    }
    /**
     * @Route("/modele/gestion", name="mdl_gst")
     */
    public function modeleLstGst(TmodeleRepository $tmodeleRepository, Request $request): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormMdl::class, $data);
        $form->handleRequest($request);
        $tmodele = $tmodeleRepository->findSearch($data);

        // if (!$tcotation) {
        //     throw $this->createNotFoundException("Erreur d'appel cotation X");
        // }
        return $this->render('/modele/mdlGst.html.twig', [
            'tmodele' => $tmodele,
            'form' => $form->createView(),

        ]);
    }
}
