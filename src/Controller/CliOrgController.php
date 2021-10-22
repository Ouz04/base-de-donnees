<?php

namespace App\Controller;

use App\Entity\TcliOrg;
use App\Form\CliOrgType;
use App\Repository\TcliOrgRepository;
use App\Repository\TgritarettRepository;
use App\Repository\TgritarpstRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CliOrgController extends AbstractController
{
    /**
     * @Route("/admin/cliorg/creat", name="cliorg_creat")
     */
    public function CliOrgCreat(Request $request,TcliOrgRepository $tcliOrgRepository, EntityManagerInterface $em): Response
    {
        $tcliorg = new TcliOrg;

        $tcliorg->setUsrIns($this->getUser());
        $tcliorg->setDatIns(new \DateTime('now'));
        
        $form = $this->createForm(CliOrgType::class, $tcliorg, [
            'attr' => [
                'readonly' => false,
                'disabled' => false
            ],


        ]);
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {
            $tcliorg = $form->getData();          
            $nom=$form->get('clrCli')->getData();
           // dd($nom);
            $cod=$tcliOrgRepository->findOneBy(['clrCli'=>$nom]);
         
            if ($cod) {
                $this->addFlash("warning", "Enregistrement existe déja");
            }else {
                $em->persist($tcliorg);
                $this->addFlash("success", "Enregistrement ajouté");
            }    
            $em->flush();
            return $this->redirectToRoute('cliorg_gst');
        }
        return $this->render('cliorg/cliorgCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'Client-Organisation'

        ]);
    }
    /**
     * @Route("/admin/cliorg/edit/{id}", name="cliorg_modif")
     */
    public function CliOrgModif($id, TcliOrgRepository $tcliOrgRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tcliorg = $tcliOrgRepository->findOneBy(['id' => $id]);

        $clrCli = $tcliorg->getClrCli();
        $clrOgr = $tcliorg->getClrOrg();

        $form = $this->createForm(CliOrgType::class, $tcliorg, [
            'attr' => [
                'readonly' => true,
                'disabled' => true
            ],


        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tcliorg->setClrCli($clrCli);
            $tcliorg->setClrOrg($clrOgr);
            $tcliorg->setUsrUpd($this->getUser());
            $tcliorg->setDatUpd(new \DateTime('now'));
            $em->flush();

            return $this->redirectToRoute('cliorg_gst');
        }
        return $this->render('cliorg/cliorgCM.html.twig', [
            'formView' => $form->createView(),
            'tusrcml' => $tcliorg,
            'titre1' => 'Modification ',
            'titre2' => 'Client-Organisation'

        ]);
    }
    /**
     * @Route("/admin/cliorg/supp/{id}", name="cliorg_supp")
     */
    public function cotationSupp($id, TcliOrgRepository $tcliOrgRepository, TgritarettRepository $tgritarettRepository, TgritarpstRepository $tgritarpstRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tcliorg = $tcliOrgRepository->findOneBy(['id' => $id]);

        if (!$tcliorg) {
            throw $this->createNotFoundException("Le client' $id n'existe pas et ne peut pas être supprimé");
        }
        $em->remove($tcliorg);
        $em->flush();
        $this->addFlash("success", "Enregistrement supprimé");

        return $this->redirectToRoute("cliorg_gst");
    }

    /**
     * @Route("/admin/cliorg/gestion", name="cliorg_gst")
     */
    public function CliOrgListGst(TcliOrgRepository $tcliOrgRepository): Response
    {
        $tcliorg = $tcliOrgRepository->findBy([], ['clrCli' => 'ASC']);

        // if (!$tusrcml) {
        //     throw $this->createNotFoundException("Erreur d'appel utilisateur X");
        // }
        return $this->render('/cliorg/cliorgGst.html.twig', [
            'tcliorg' => $tcliorg,

        ]);
    }
}
