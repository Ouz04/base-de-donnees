<?php

namespace App\Controller;

use App\Entity\Tsite;
use App\Form\SiteType;
use App\Entity\Tdictab;
use App\Entity\Tsitweb;
use App\Form\DictabType;
use App\Form\SitewebType;


use App\Repository\TsiteRepository;
use App\Repository\TclientRepository;
use App\Repository\TdictabRepository;
use App\Repository\TsitwebRepository;
use App\Repository\TarticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SitwebController extends AbstractController
{
    /**
     * @Route("admin/sitweb/creat", name="sitweb_creat")
     */
    public function sitwebCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = new Tsitweb;
        $tsoc->setUsrIns($this->getUser());
        $tsoc->setDatIns(new \DateTime('now'));

        $form01 = $this->createForm(SitewebType::class,  $tsoc, [
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

            return $this->redirectToRoute('sitweb_gst');
        } else {

            $this->addFlash("error", "Zones Famcli non renseignées");
        }

        return $this->render('sitweb/sitwebCM.html.twig', [
            'form' => $form01->createView(),
            'titre1' => 'Création ',
            'titre2' => 'Site web',
        ]);
    }
    /**
     * @Route("admin/sitweb/edit/{id}", name="sitweb_modif")
     */
    public function sitwebModif($id, TsitwebRepository $tsitwebRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tsoc = $tsitwebRepository->findOneBy(['id' => $id]);

        $form01 = $this->createForm(SitewebType::class,   $tsoc, [
            'attr' => [
                'readonly' => true,
                'disabled' => false
            ],
        ]);

        $form01->handleRequest($request);
        if ($form01->isSubmitted() && $form01->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('sitweb_gst');
        }
        return $this->render('sitweb/sitwebCM.html.twig', [
            'form' => $form01->createView(),
            'tfamcli' => $tsoc,
            'titre1' => 'Modification ',
            'titre2' => 'Site web'

        ]);
    }
    /**
     * @Route("admin/sitweb/supp/{id}", name="sitweb_supp")
     */
    public function  sitwebSupp($id, TsitwebRepository $tsitwebRepository,TclientRepository $tclientRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = $tsitwebRepository->findOneBy(['id' => $id]);

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

        return $this->redirectToRoute("sitweb_gst");
    }
    /**
     * @Route("admin/sitweb/gestion", name="sitweb_gst")
     */
    public function sitwebListShow(TsitwebRepository $tsitwebRepository,  Request $request): Response
    {

        $tsoc = $tsitwebRepository->findAll();

        return $this->render('sitweb/sitwebGst.html.twig', [
            'tsoc' => $tsoc,

        ]);
    }
}
