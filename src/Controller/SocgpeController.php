<?php

namespace App\Controller;

use App\Entity\Tfamcli;
use App\Entity\Tsocgpe;
use App\Entity\Tsociete;
use App\Form\FamcliType;
use App\Form\SocgpeType;
use App\Form\SocieteType;
use App\Repository\TarticleRepository;
use App\Repository\TclientRepository;
use App\Repository\TfamcliRepository;
use App\Repository\TsocieteRepository;
use App\Repository\TbpartnerRepository;
use App\Repository\TsocgpeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SocgpeController extends AbstractController
{
    /**
     * @Route("admin/socgpe/creat", name="socgpe_creat")
     */
    public function SocgpeCreat(Request $request,TsocgpeRepository $tsocgpeRepository, EntityManagerInterface $em): Response
    {
        $tsoc = new Tsocgpe;
        $tsoc->setUsrIns($this->getUser());
        $tsoc->setDatIns(new \DateTime('now'));

        $form01 = $this->createForm(SocgpeType::class,  $tsoc, [
            'attr' => [
                'readonly' => false,
                'disabled' => false
            ]
        ]);
        $form01->handleRequest($request);


        if ($form01->issubmitted() && $form01->isValid()) {
            //dd($form01);

            $tsoc = $form01->getData();          
            $nom=$form01->get('cod')->getData();
            $cod=$tsocgpeRepository->findOneBy(['cod'=>$nom]);
         
            if ($cod) {
                $this->addFlash("warning", "Enregistrement existe déja");
            }else {
                $em->persist( $tsoc);
                $this->addFlash("success", "Enregistrement ajouté");
            }    
            $em->flush();  

            return $this->redirectToRoute('socgpe_gst');
        } else {

            $this->addFlash("error", "Zones Famcli non renseignées");
        }

        return $this->render('socgpe/socgpeCM.html.twig', [
            'form' => $form01->createView(),
            'titre1' => 'Création ',
            'titre2' => 'Groupe Societe',
        ]);
    }
    /**
     * @Route("admin/socgpe/edit/{id}", name="socgpe_modif")
     */
    public function SocgpeModif($id, TsocgpeRepository $tsocgpeRepository, TbpartnerRepository $tbpartnerRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tsoc = $tsocgpeRepository->findOneBy(['id' => $id]);

        $form01 = $this->createForm(SocgpeType::class,   $tsoc, [
            'attr' => [
                'readonly' => true,
                'disabled' => false
            ],
        ]);

        $form01->handleRequest($request);
        if ($form01->isSubmitted() && $form01->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('socgpe_gst');
        }
        return $this->render('socgpe/socgpeCM.html.twig', [
            'form' => $form01->createView(),
            'tfamcli' => $tsoc,
            'titre1' => 'Modification ',
            'titre2' => 'Groupe Societe'

        ]);
    }
    /**
     * @Route("admin/socgpe/supp/{id}", name="socgpe_supp")
     */
    public function SocgpeSupp($id, TsocgpeRepository $tsocgpeRepository,TclientRepository $tclientRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = $tsocgpeRepository->findOneBy(['id' => $id]);

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
        }
        else {
            $em->remove($tsoc);
            $em->flush();
            $this->addFlash("success", "Enregistrement supprimé");
        }

        return $this->redirectToRoute("socgpe_gst");
    }
    /**
     * @Route("admin/socgpe/gestion", name="socgpe_gst")
     */
    public function societeListShow(TsocgpeRepository $tsocgpeRepository,  Request $request): Response
    {

        $tsoc = $tsocgpeRepository->findAll();

        return $this->render('socgpe/socgpeGst.html.twig', [
            'tsoc' => $tsoc,

        ]);
    }
}
