<?php

namespace App\Controller;

use DateTime;
use App\Form\OrgType;
use App\Data\SearchData;
use App\Form\SearchFormOrg;
use App\Entity\Torganisation;
use App\Repository\TcotorgRepository;
use App\Repository\TusrcmlRepository;
use App\Repository\TgritarettRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TorganisationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrganisationController extends AbstractController
{
    /**
     * @Route("/organisation/creat", name="org_creat")
     */
    public function organisationCreat(Request $request, TorganisationRepository $torganisationRepository, EntityManagerInterface $em): Response
    {
        $torganisation = new Torganisation;
        $torganisation->setUsrIns($this->getUser());
        $torganisation->setDatIns(new \DateTime('now'));

        $form = $this->createForm(OrgType::class, $torganisation, ['attr' => ['readonly' => false]]);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $torganisation = $form->getData();
            // on verifie si cod pas déjà existant
            $torganisation2 = $torganisationRepository->findBy(['cod' => $torganisation->getCod()]);
            if ($torganisation2) {
                //dd("erreur");
                $this->addFlash("warning", 'Enregistrement non effectué : il existe un enregistrement avec le même code');
            } else {


                $em->persist($torganisation);
                $em->flush();
                $this->addFlash("success", "Enregistrement ajouté");
                return $this->redirectToRoute('org_gst');
            }
        }
        return $this->render('organisation/orgCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'organisation'

        ]);
    }
    /**
     * @Route("/organisation/edit/{id}", name="org_modif")
     */
    public function organisationModif($id, TorganisationRepository $torganisationRepository, Request $request, EntityManagerInterface $em): Response
    {

        $torganisation = $torganisationRepository->findOneBy(['id' => $id]);
        $torganisation->setUsrUpd($this->getUser());
        $torganisation->setDatUpd(new \DateTime('now'));
        $form = $this->createForm(OrgType::class, $torganisation, ['attr' => ['readonly' => true]]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $product = $form->getData();

            $em->flush();
            $this->addFlash("success", "Enregistrement modifié");
            return $this->redirectToRoute('org_gst');
        }
        return $this->render('organisation/orgCM.html.twig', [
            'formView' => $form->createView(),
            'torganisation' => $torganisation,
            'titre1' => 'Modification ',
            'titre2' => 'organisation'

        ]);
    }
    /**
     * @Route("/organisation/supp/{id}", name="org_supp")
     */
    public function organisationSupp($id, TorganisationRepository $torganisationRepository, TcotorgRepository $tcotorgRepository, TgritarettRepository $tgritarettRepository, Request $request, EntityManagerInterface $em): Response
    {
        $torganisation = $torganisationRepository->findOneBy(['id' => $id]);

        if (!$torganisation) {
            throw $this->createNotFoundException("L'organisation $id n'existe pas et ne peut pas être supprimée");
        }
        $tcotorg = $tcotorgRepository->findBy(['clrCot' => $torganisation->getId()]);
        if ($tcotorg) {
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (cotorg) ');
            //   throw $this->createNotFoundException("L'organisation $id ne peut pas être supprimée car il y a au moins une liaison (cotorg)");
        } else {
            $gritarett = $tgritarettRepository->findBy(['clrOrg' => $torganisation->getId()]);
            if ($gritarett) {
                $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (gritarett) ');
                //  throw $this->createNotFoundException("L'organisation' $id ne peut pas être supprimée car il y a au moins une liaison(artcot)");
            } else {
                $em->remove($torganisation);
                $em->flush();
                $this->addFlash("success", "Enregistrement supprimé");
            }
        }

        return $this->redirectToRoute("org_gst");
    }
    /**
     * @Route("/organisation/gestion", name="org_gst")
     */
    public function organisationLstGst(TorganisationRepository $torganisationRepository, TusrcmlRepository $tusrcmlRepository, Request $request): Response
    {
        $tusrcml = $tusrcmlRepository->findBy(['clrUsr' => $this->getUser()]);
        $idUsr = null;
        if ($tusrcml) {
            $torganisation = $torganisationRepository->findBy(['clrCml' => $tusrcml[0]->getClrCml()], ['nom' => 'ASC']);
            $idUsr = $this->getUser()->getId();
        }


        $data = new SearchData;
        $form = $this->createForm(SearchFormOrg::class, $data);
        $form->handleRequest($request);
        $torganisation = $torganisationRepository->findSearch($data, $idUsr);
        return $this->render('/organisation/orgGst.html.twig', [
            'torganisation' => $torganisation,
            'form' => $form->createView(),

        ]);
    }
    
}
