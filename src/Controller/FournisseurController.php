<?php

namespace App\Controller;

use App\Form\FouType;
use App\Form\FouCreatType;
use App\Form\FouModifType;
use App\Entity\Tfournisseur;
use App\Repository\TarticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TfournisseurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FournisseurController extends AbstractController
{
    /**
     * @Route("/mkt/fournisseur/creat", name="fou_creat")
     */
    public function fournisseurCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tfournisseur = new Tfournisseur;
        $tfournisseur->setUsrIns($this->getUser());
        $tfournisseur->setDatIns(new \DateTime('now'));
        $form = $this->createForm(FouType::class, $tfournisseur, ['attr' => ['readonly' => false]]);
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {
            $tfournisseur = $form->getData();

            $em->persist($tfournisseur);
            $em->flush();
            return $this->redirectToRoute('fou_gst');
        }
        return $this->render('fournisseur/fouCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'fournisseur'

        ]);
    }
    /**
     * @Route("/mkt/fournisseur/edit/{id}", name="fou_modif")
     */
    public function fournisseurModif($id, TfournisseurRepository $tfournisseurRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tfournisseur = $tfournisseurRepository->findOneBy(['id' => $id]);
        $tfournisseur->setUsrUpd($this->getUser());
        $tfournisseur->setDatUpd(new \DateTime('now'));
        $form = $this->createForm(FouType::class, $tfournisseur, ['attr' => ['readonly' => true]]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $product = $form->getData();

            $em->flush();
            $this->addFlash("success", "Enregistrement modifié");
            return $this->redirectToRoute('fou_gst');
        }
        return $this->render('fournisseur/fouCM.html.twig', [
            'formView' => $form->createView(),
            'tfournisseur' => $tfournisseur,
            'titre1' => 'Modification ',
            'titre2' => 'fournisseur'

        ]);
    }
    /**
     * @Route("/mkt/fournisseur/supp/{id}", name="fou_supp")
     */
    public function fournisseurSupp($id, TfournisseurRepository $tfournisseurRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tfournisseur = $tfournisseurRepository->findOneBy(['id' => $id]);


        if (!$tfournisseur) {
            throw $this->createNotFoundException("Le fournisseur $id n'existe pas et ne peut pas être supprimé");
        }
        $tarticle = $tarticleRepository->findBy(['clrfou' => $tfournisseur->getId()]);
        if ($tarticle) {
            throw $this->createNotFoundException("Le fournisseur $id ne peut pas être supprimé car il y a au moins un article lié");
        }
        $em->remove($tfournisseur);
        $em->flush();
        $this->addFlash("success", "Enregistrement supprimé");

        return $this->redirectToRoute("fouGst_gst");
    }
    /**
     * @Route("/mkt/fournisseur/gestion", name="fou_gst")
     */
    public function fournisseurListShow(TfournisseurRepository $fournisseurRepository): Response
    {
        $tfournisseur = $fournisseurRepository->findBy([], ['cod' => 'ASC']);

        return $this->render('/fournisseur/fouGst.html.twig', [
            'tfournisseur' => $tfournisseur,

        ]);
    }
}
