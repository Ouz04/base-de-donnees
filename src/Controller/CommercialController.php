<?php

namespace App\Controller;

use App\Form\CmlType;
use App\Form\CmlCreatType;
use App\Form\CmlModifType;
use App\Entity\Tcommercial;
use App\Repository\TusrcmlRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TcommercialRepository;
use App\Repository\TorganisationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommercialController extends AbstractController
{
    /**
     * @Route("/admin/commercial/creat", name="cml_creat")
     */
    public function commercialCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tcommercial = new Tcommercial;
        $tcommercial->setUsrIns($this->getUser());
        $tcommercial->setDatIns(new \DateTime('now'));

        $form = $this->createForm(CmlType::class, $tcommercial, ['attr' => ['readonly' => false]]);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tcommercial = $form->getData();

            $em->persist($tcommercial);
            $em->flush();
            return $this->redirectToRoute('cml_gst');
        }
        return $this->render('/commercial/cmlCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'commercial'

        ]);
    }
    /**
     * @Route("/admin/commercial/edit/{id}", name="cml_modif")
     */
    public function commercialModif($id, TcommercialRepository $tcommercialRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tcommercial = $tcommercialRepository->findOneBy(['id' => $id]);
        $tcommercial->setUsrUpd($this->getUser());
        $tcommercial->setDatUpd(new \DateTime('now'));
        $form = $this->createForm(CmlType::class, $tcommercial, ['attr' => ['readonly' => true]]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('cml_gst');
        }
        return $this->render('/commercial/cmlCM.html.twig', [
            'formView' => $form->createView(),
            'tcommercial' => $tcommercial,
            'titre1' => 'Modification ',
            'titre2' => 'commercial'

        ]);
    }
    /**
     * @Route("/admin/commercial/supp/{id}", name="cml_supp")
     */
    public function cotationSupp($id, TcommercialRepository $tcommercialRepository, TusrcmlRepository $tusrcmlRepository, TorganisationRepository $torganisationRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tcommercial = $tcommercialRepository->findOneBy(['id' => $id]);

        if (!$tcommercial) {
            throw $this->createNotFoundException("Le commercial $id n'existe pas et ne peut pas être supprimé");
        }
        $tusrcml = $tusrcmlRepository->findBy(['clrCml' => $tcommercial->getId()]);
        if ($tusrcml) {
            // throw $this->createNotFoundException("La cotation $id ne peut pas être supprimée car il y a au moins une liaison (cotorg)");
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (usrcml) ');
        } else {
            $torganisation = $torganisationRepository->findBy(['clrCml' => $tcommercial->getId()]);
            if ($torganisation) {
                $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (organisation) ');
                //   throw $this->createNotFoundException("La cotation $id ne peut pas être supprimée car il y a au moins une liaison(artcot)");
            } else {
                $em->remove($tcommercial);
                $em->flush();
                $this->addFlash("success", "Enregistrement supprimé");
            }
        }

        return $this->redirectToRoute("cml_gst");
    }

    /**
     * @Route("/admin/commercial/gestion", name="cml_gst")
     */
    public function commercialListShow(TcommercialRepository $tcommercialRepository): Response
    {
        $tcommercial = $tcommercialRepository->findBy([], ['cod' => 'ASC']);


        return $this->render('/commercial/cmlGst.html.twig', [
            'tcommercial' => $tcommercial,

        ]);
    }
}
