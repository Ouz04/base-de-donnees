<?php

namespace App\Controller;

use App\Entity\Tfamcli;
use App\Entity\Tsociete;
use App\Form\FamcliType;
use App\Form\SocieteType;
use App\Entity\Tdictionnaire;
use App\Form\DictionnaireType;
use App\Repository\TclientRepository;
use App\Repository\TfamcliRepository;
use App\Repository\TarticleRepository;
use App\Repository\TsocieteRepository;
use App\Repository\TbpartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TdictionnaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DictionnaireController extends AbstractController
{
    /**
     * @Route("admin/dic/creat", name="dic_creat")
     */
    public function DictionnaireCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = new Tdictionnaire;
        $tsoc->setUsrIns($this->getUser());
        $tsoc->setDatIns(new \DateTime('now'));

        $form01 = $this->createForm(DictionnaireType::class,  $tsoc, [
            'attr' => [
                'readonly' => false,
                'disabled' => false
            ]
        ]);
        $form01->handleRequest($request);


        if ($form01->issubmitted() && $form01->isValid()) {
            //dd($form01);

            $tsoc = $form01->getData();
           
            $nom=$request->query->get('cod');

            $em->persist( $tsoc);

            $em->flush();

            $this->addFlash("success", "Enregistrement ajouté");

            return $this->redirectToRoute('dic_gst');
        } else {

            $this->addFlash("error", "Zones Famcli non renseignées");
        }

        return $this->render('dictionnaire/dicCM.html.twig', [
            'form' => $form01->createView(),
            'titre1' => 'Création ',
            'titre2' => 'Societe',
        ]);
    }
    /**
     * @Route("admin/dic/edit/{id}", name="dic_modif")
     */
    public function SocieteModif($id, TdictionnaireRepository $tdictionnaireRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tsoc = $tdictionnaireRepository->findOneBy(['id' => $id]);

        $form01 = $this->createForm(DictionnaireType::class,   $tsoc, [
            'attr' => [
                'readonly' => true,
                'disabled' => false
            ],
        ]);

        $form01->handleRequest($request);
        if ($form01->isSubmitted() && $form01->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('dic_gst');
        }
        return $this->render('dictionnaire/dicCM.html.twig', [
            'form' => $form01->createView(),
            'tfamcli' => $tsoc,
            'titre1' => 'Modification ',
            'titre2' => 'famille client'

        ]);
    }
    /**
     * @Route("admin/dic/supp/{id}", name="dic_supp")
     */
    public function SocieteSupp($id, TdictionnaireRepository $tdictionnaireRepository,TclientRepository $tclientRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = $tdictionnaireRepository->findOneBy(['id' => $id]);

        if (!$tsoc) {
            throw $this->createNotFoundException("La societe $id n'existe pas et ne peut pas être supprimée");
        }
        $tclient = $tclientRepository->findBy(['clrSoc' =>  $tsoc->getId()]);
        if ($tclient) {
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (client) ');
            //   throw $this->createNotFoundException("L'organisation $id ne peut pas être supprimée car il y a au moins une liaison (cotorg)");
        }
        $tarticle = $tarticleRepository->findBy(['clrApcAdx' =>  $tsoc->getId()]);
        if ($tarticle) {
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (article) ');
            //   throw $this->createNotFoundException("L'organisation $id ne peut pas être supprimée car il y a au moins une liaison (cotorg)");
        }else {
            $em->remove($tsoc);
            $em->flush();
            $this->addFlash("success", "Enregistrement supprimé");
        }

        return $this->redirectToRoute("dic_gst");
    }
    /**
     * @Route("admin/dic/gestion", name="dic_gst")
     */
    public function societeListShow(TdictionnaireRepository $tdictionnaireRepository,  Request $request): Response
    {

        $tsoc = $tdictionnaireRepository->findAll();

        return $this->render('dictionnaire/dicGst.html.twig', [
            'tsoc' => $tsoc,

        ]);
    }
}
