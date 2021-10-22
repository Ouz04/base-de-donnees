<?php

namespace App\Controller;

use App\Entity\Tdictab;
use App\Entity\Tsite;
use App\Form\DictabType;
use App\Form\SiteType;
use App\Repository\TclientRepository;


use App\Repository\TdictabRepository;
use App\Repository\TarticleRepository;
use App\Repository\TsiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SiteController extends AbstractController
{
    /**
     * @Route("admin/site/creat", name="site_creat")
     */
    public function  siteCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = new Tsite;
        $tsoc->setUsrIns($this->getUser());
        $tsoc->setDatIns(new \DateTime('now'));

        $form01 = $this->createForm(SiteType::class,  $tsoc, [
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

            return $this->redirectToRoute('site_gst');
        } else {

            $this->addFlash("error", "Zones Famcli non renseignées");
        }

        return $this->render('site/siteCM.html.twig', [
            'form' => $form01->createView(),
            'titre1' => 'Création ',
            'titre2' => 'Site entreprise',
        ]);
    }
    /**
     * @Route("admin/site/edit/{id}", name="site_modif")
     */
    public function siteModif($id, TsiteRepository $tsiteRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tsoc = $tsiteRepository->findOneBy(['id' => $id]);

        $form01 = $this->createForm(SiteType::class,   $tsoc, [
            'attr' => [
                'readonly' => true,
                'disabled' => false
            ],
        ]);

        $form01->handleRequest($request);
        if ($form01->isSubmitted() && $form01->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('site_gst');
        }
        return $this->render('site/siteCM.html.twig', [
            'form' => $form01->createView(),
            'tfamcli' => $tsoc,
            'titre1' => 'Modification ',
            'titre2' => 'Site entreprise'

        ]);
    }
    /**
     * @Route("admin/site/supp/{id}", name="site_supp")
     */
    public function  DictabSupp($id, TsiteRepository $tsiteRepository,TclientRepository $tclientRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = $tsiteRepository->findOneBy(['id' => $id]);

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

        return $this->redirectToRoute("site_gst");
    }
    /**
     * @Route("admin/site/gestion", name="site_gst")
     */
    public function DictabListShow(TsiteRepository $tsiteRepository,  Request $request): Response
    {

        $tsoc = $tsiteRepository->findAll();

        return $this->render('site/siteGst.html.twig', [
            'tsoc' => $tsoc,

        ]);
    }
}
