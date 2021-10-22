<?php

namespace App\Controller;

use App\Entity\Tsite;
use App\Form\SiteType;
use App\Entity\Tdictab;
use App\Entity\Tservice;
use App\Form\DictabType;
use App\Form\ServiceType;
use App\Repository\TsiteRepository;
use App\Repository\TclientRepository;
use App\Repository\TdictabRepository;
use App\Repository\TarticleRepository;
use App\Repository\TserviceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    /**
     * @Route("admin/service/creat", name="service_creat")
     */
    public function  serviceCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = new Tservice;
        $tsoc->setUsrIns($this->getUser());
        $tsoc->setDatIns(new \DateTime('now'));

        $form01 = $this->createForm(ServiceType::class,  $tsoc, [
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

            return $this->redirectToRoute('service_gst');
        } else {

            $this->addFlash("error", "Zones Famcli non renseignées");
        }

        return $this->render('service/serviceCM.html.twig', [
            'form' => $form01->createView(),
            'titre1' => 'Création ',
            'titre2' => 'Service entreprise',
        ]);
    }
    /**
     * @Route("admin/service/edit/{id}", name="service_modif")
     */
    public function serviceModif($id, TserviceRepository $tserviceRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tsoc = $tserviceRepository->findOneBy(['id' => $id]);

        $form01 = $this->createForm(ServiceType::class,   $tsoc, [
            'attr' => [
                'readonly' => true,
                'disabled' => false
            ],
        ]);

        $form01->handleRequest($request);
        if ($form01->isSubmitted() && $form01->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('service_gst');
        }
        return $this->render('service/serviceCM.html.twig', [
            'form' => $form01->createView(),
            'tfamcli' => $tsoc,
            'titre1' => 'Modification ',
            'titre2' => 'Service entreprise'

        ]);
    }
    /**
     * @Route("admin/service/supp/{id}", name="service_supp")
     */
    public function  serviceSupp($id, TserviceRepository $tserviceRepository,TclientRepository $tclientRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = $tserviceRepository->findOneBy(['id' => $id]);

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

        return $this->redirectToRoute("service_gst");
    }
    /**
     * @Route("admin/service/gestion", name="service_gst")
     */
    public function serviceListShow(TserviceRepository $tserviceRepository,  Request $request): Response
    {

        $tsoc = $tserviceRepository->findAll();

        return $this->render('service/serviceGst.html.twig', [
            'tsoc' => $tsoc,

        ]);
    }
}
