<?php

namespace App\Controller;

use App\Entity\Tusrcml;
use App\Form\UsrcmlType;
use App\Repository\TusrcmlRepository;
use App\Repository\TgritarettRepository;
use App\Repository\TgritarpstRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsrcmlController extends AbstractController
{
    /**
     * @Route("/admin/usrcml/creat", name="usrcml_creat")
     */
    public function usrcmlCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tusrcml = new Tusrcml;

        $tusrcml->setUsrIns($this->getUser());
        $tusrcml->setDatIns(new \DateTime('now'));
        if (!$tusrcml->getDatDeb()) {
            $tusrcml->SetDatDeb(new \DateTime('now'));
            $tusrcml->SetDatFin(new \DateTime('99991231'));
        }
        $form = $this->createForm(UsrcmlType::class, $tusrcml, [
            'attr' => [
                'readonly' => false,
                'disabled' => false
            ],


        ]);
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {
            //   $tuser = $form->getData();

            $em->persist($tusrcml);
            $em->flush();
            return $this->redirectToRoute('usrcml_gst');
        }
        return $this->render('usrcml/usrcmlCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'utilisateur-commercial'

        ]);
    }
    /**
     * @Route("/admin/usrcml/edit/{id}", name="usrcml_modif")
     */
    public function usrcmlModif($id, TusrcmlRepository $tusrcmlRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tusrcml = $tusrcmlRepository->findOneBy(['id' => $id]);

        $clrUsr = $tusrcml->getClrUsr();
        $clrCml = $tusrcml->getClrCml();

        $form = $this->createForm(UsrcmlType::class, $tusrcml, [
            'attr' => [
                'readonly' => true,
                'disabled' => true
            ],


        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tusrcml->setClrUsr($clrUsr);
            $tusrcml->setClrCml($clrCml);
            $tusrcml->setUsrUpd($this->getUser());
            $tusrcml->setDatUpd(new \DateTime('now'));
            $em->flush();

            return $this->redirectToRoute('usrcml_gst');
        }
        return $this->render('usrcml/usrcmlCM.html.twig', [
            'formView' => $form->createView(),
            'tusrcml' => $tusrcml,
            'titre1' => 'Modification ',
            'titre2' => 'utilisateur-commercial'

        ]);
    }
    /**
     * @Route("/admin/usrcml/supp/{id}", name="usrcml_supp")
     */
    public function cotationSupp($id, TusrcmlRepository $tusrcmlRepository, TgritarettRepository $tgritarettRepository, TgritarpstRepository $tgritarpstRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tusrcml = $tusrcmlRepository->findOneBy(['id' => $id]);

        if (!$tusrcml) {
            throw $this->createNotFoundException("L'utilisateur' $id n'existe pas et ne peut pas être supprimé");
        }
        $em->remove($tusrcml);
        $em->flush();
        $this->addFlash("success", "Enregistrement supprimé");

        return $this->redirectToRoute("usrcml_gst");
    }

    /**
     * @Route("/admin/usrcml/gestion", name="usrcml_gst")
     */
    public function usrcmlListGst(TusrcmlRepository $tusrcmlRepository): Response
    {
        $tusrcml = $tusrcmlRepository->findBy([], ['clrUsr' => 'ASC']);

        // if (!$tusrcml) {
        //     throw $this->createNotFoundException("Erreur d'appel utilisateur X");
        // }
        return $this->render('/usrcml/usrcmlGst.html.twig', [
            'tusrcml' => $tusrcml,

        ]);
    }
}
