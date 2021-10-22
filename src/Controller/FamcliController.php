<?php

namespace App\Controller;

use App\Entity\Tfamcli;

use App\Form\FamcliType;
use App\Repository\TclientRepository;
use App\Repository\TfamcliRepository;
use App\Repository\TbpartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FamcliController extends AbstractController
{
    /**
     * @Route("admin/famcli/creat", name="famcli_creat")
     */
    public function FamcliCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tfamcli = new Tfamcli;
        $tfamcli->setUsrIns($this->getUser());
        $tfamcli->setDatIns(new \DateTime('now'));

        $form01 = $this->createForm(FamcliType::class, $tfamcli, [
            'attr' => [
                'readonly' => false,
                'disabled' => false
            ]
        ]);
        $form01->handleRequest($request);


        if ($form01->issubmitted() && $form01->isValid()) {
            //dd($form01);

            $tfamcli = $form01->getData();

            $em->persist($tfamcli);

            $em->flush();

            $this->addFlash("success", "Enregistrement ajouté");

            return $this->redirectToRoute('famcli_gst');
        } else {

            $this->addFlash("error", "Zones Famcli non renseignées");
        }

        return $this->render('famcli/famcliCM.html.twig', [
            'form' => $form01->createView(),
            'titre1' => 'Création ',
            'titre2' => 'famille client',
        ]);
    }
    /**
     * @Route("admin/famcli/edit/{id}", name="famcli_modif")
     */
    public function FamcliModif($id, TfamcliRepository $tFamcliRepository, TbpartnerRepository $tbpartnerRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tfamcli = $tFamcliRepository->findOneBy(['id' => $id]);

        $form01 = $this->createForm(FamcliType::class, $tfamcli, [
            'attr' => [
                'readonly' => true,
                'disabled' => false
            ],
        ]);

        $form01->handleRequest($request);
        if ($form01->isSubmitted() && $form01->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('famcli_gst');
        }
        return $this->render('famcli/famcliCM.html.twig', [
            'form' => $form01->createView(),
            'tfamcli' => $tfamcli,
            'titre1' => 'Modification ',
            'titre2' => 'famille client'

        ]);
    }
    /**
     * @Route("admin/famcli/supp/{id}", name="famcli_supp")
     */
    public function FamcliSupp($id, TFamcliRepository $tFamcliRepository, TclientRepository $tclientRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tfamcli = $tFamcliRepository->findOneBy(['id' => $id]);

        if (!$tfamcli) {
            throw $this->createNotFoundException("La Famille client $id n'existe pas et ne peut pas être supprimée");
        }
        $tclient = $tclientRepository->findBy(['clrFamcli' => $tfamcli->getId()]);
        if ($tclient) {
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (client) ');
            //   throw $this->createNotFoundException("L'organisation $id ne peut pas être supprimée car il y a au moins une liaison (cotorg)");
        } else {
            $em->remove($tfamcli);
            $em->flush();
            $this->addFlash("success", "Enregistrement supprimé");
        }

        return $this->redirectToRoute("famcli_gst");
    }
    /**
     * @Route("admin/famcli/gestion", name="famcli_gst")
     */
    public function FamcliListShow(TfamcliRepository $tfamcliRepository,  Request $request): Response
    {

        $tfamcli = $tfamcliRepository->findAll();

        return $this->render('famcli/famcliGst.html.twig', [
            'tfamcli' => $tfamcli,

        ]);
    }
}
