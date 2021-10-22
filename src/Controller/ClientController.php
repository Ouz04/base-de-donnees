<?php

namespace App\Controller;

use App\Form\CliType;
use App\Form\SearchFormCli;
use App\Entity\Tclient;
use App\Data\SearchData;
use App\Repository\TclientRepository;
use App\Repository\TcotcliRepository;
use App\Repository\TusrcmlRepository;
use App\Repository\TbpartnerRepository;
use App\Repository\TgritarettRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    /**
     * @Route("/cli/creat", name="cli_creat")
     */
    public function clientCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tclient = new Tclient;
        $tclient->setUsrIns($this->getUser());
        $tclient->setDatIns(new \DateTime('now'));

        $form01 = $this->createForm(CliType::class, $tclient, [
            'attr' => [
                'readonly' => false,
            ]
        ]);
        $form01->handleRequest($request);


        if ($form01->issubmitted() && $form01->isValid()) {
            //dd($form01);

            $tclient = $form01->getData();

            $em->persist($tclient);

            $em->flush();

            $this->addFlash("success", "Enregistrement ajouté");
         
            return $this->redirectToRoute('cli_gst');
        } else {
           
            $this->addFlash("error", "Zones client non renseignées");
        }

        return $this->render('client/cliCM.html.twig', [
            'formView01' => $form01->createView(),
            'titre1' => 'Création ',
            'titre2' => 'client',
        ]);
    }
    /**
     * @Route("/cli/edit/{id}", name="cli_modif")
     */
    public function clientModif($id, TclientRepository $tclientRepository, TbpartnerRepository $tbpartnerRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tclient = $tclientRepository->findOneBy(['id' => $id]);

        $form01 = $this->createForm(CliType::class, $tclient, [
            'attr' => [
                'readonly' => true,
            ],
        ]);

        $form01->handleRequest($request);
        if ($form01->isSubmitted() && $form01->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('cli_gst');
        }
        return $this->render('client/cliCM.html.twig', [
            'formView01' => $form01->createView(),
            'tclient' => $tclient,
            'titre1' => 'Modification ',
            'titre2' => 'client'

        ]);
    }
    /**
     * @Route("/cli/supp/{id}", name="cli_supp")
     */
    public function clientSupp($id, TclientRepository $tclientRepository, TcotcliRepository $tcotcliRepository, TgritarettRepository $tgritarettRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tclient = $tclientRepository->findOneBy(['id' => $id]);

        if (!$tclient) {
            throw $this->createNotFoundException("Le client $id n'existe pas et ne peut pas être supprimé");
        }
        $tcotcli = $tcotcliRepository->findBy(['clrCot' => $tclient->getId()]);
        if ($tcotcli) {
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (cotcli) ');
            //   throw $this->createNotFoundException("L'organisation $id ne peut pas être supprimée car il y a au moins une liaison (cotorg)");
        } else {
            $gritarett = $tgritarettRepository->findBy(['clrOrg' => $tclient->getId()]);
            if ($gritarett) {
                $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (gritarett) ');
                //  throw $this->createNotFoundException("L'organisation' $id ne peut pas être supprimée car il y a au moins une liaison(artcot)");
            } else {
                $em->remove($tclient);
                $em->flush();
                $this->addFlash("success", "Enregistrement supprimé");
            }
        }
        return $this->redirectToRoute("cli_gst");
    }
    /**
     * @Route("/cli/gestion", name="cli_gst")
     */
    public function clientListShow(TclientRepository $tclientRepository, TusrcmlRepository $tusrcmlRepository, Request $request): Response
    {
        $tusrcml = $tusrcmlRepository->findBy(['clrUsr' => $this->getUser()]);
        $idUsr = null;
        if ($tusrcml) {
            $tclient = $tclientRepository->findBy(['clrCml' => $tusrcml[0]->getClrCml()], ['nom' => 'ASC']);
            $idUsr = $this->getUser()->getId();
        }

        // $tclient = $tclientRepository->findAll();
        $data = new SearchData;
        $form = $this->createForm(SearchFormcli::class, $data);
        $form->handleRequest($request);
        $tclient = $tclientRepository->findSearch($data, $idUsr);
        return $this->render('/client/cliGst.html.twig', [
            'tclient' => $tclient,
            'form' => $form->createView(),

        ]);
    }
    /**
     * @Route("/client/gritar/gestion", name="cli_gst_gta")
     */
    public function clientLstGstBis(TclientRepository $tclientRepository, TusrcmlRepository $tusrcmlRepository, Request $request): Response
    {
        $tusrcml = $tusrcmlRepository->findBy(['clrUsr' => $this->getUser()]);
        $idUsr = null;

        if ($tusrcml) {
            $tclient = $tclientRepository->findBy(['clrCml' => $tusrcml[0]->getClrCml()], ['nom' => 'ASC']);
            $idUsr = $this->getUser()->getId();
        } else {
            $tclient = $tclientRepository->findAll( ['nom' => 'ASC']); 
        }
        $data = new SearchData;
        $data->setCliCod('*');
      

        return $this->render('/client/cliGstGta.html.twig', [
            'tclient' => $tclient,


        ]);
    }
}
