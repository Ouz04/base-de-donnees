<?php

namespace App\Controller;

use App\Entity\Tdicdta;
use App\Entity\Tdictab;
use App\Form\DicdtaType;
use App\Form\DictabType;

use App\recherche\Search;

use App\Data\SearchBddChp;

use App\Form\DictionnaireType;
use App\Repository\TclientRepository;
use App\Repository\TdicdtaRepository;
use App\Repository\TdictabRepository;
use App\Repository\TarticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DicdtaController extends AbstractController
{
    /**
     * @Route("admin/dicdta/creat", name="dicdta_creat")
     */
    public function  DicdtaCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = new Tdicdta;
        $tsoc->setUsrIns($this->getUser());
        $tsoc->setDatIns(new \DateTime('now'));

        $form01 = $this->createForm(DicdtaType::class,  $tsoc, [
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

            return $this->redirectToRoute('dicdta_gst');
        } else {

            $this->addFlash("error", "Zones Famcli non renseignées");
        }

        return $this->render('dicdta/dicdtaCM.html.twig', [
            'form' => $form01->createView(),
            'titre1' => 'Création ',
            'titre2' => 'Dicdta',
        ]);
    }
    /**
     * @Route("admin/dicdta/edit/{id}", name="dicdta_modif")
     */
    public function DicdtaModif($id, TdicdtaRepository $tdicdtaRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tsoc = $tdicdtaRepository->findOneBy(['id' => $id]);

        $form01 = $this->createForm(DicdtaType::class,   $tsoc, [
            'attr' => [
                'readonly' => true,
                'disabled' => false
            ],
        ]);

        $form01->handleRequest($request);
        if ($form01->isSubmitted() && $form01->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('dicdta_gst');
        }
        return $this->render('dicdta/dicdtaCM.html.twig', [
            'form' => $form01->createView(),
            'tfamcli' => $tsoc,
            'titre1' => 'Modification ',
            'titre2' => 'Dicdta'

        ]);
    }
    /**
     * @Route("admin/dicdta/supp/{id}", name="dicdta_supp")
     */
    public function  DicdtaSupp($id, TdicdtaRepository $tdicdtaRepository,TclientRepository $tclientRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = $tdicdtaRepository->findOneBy(['id' => $id]);

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

        return $this->redirectToRoute("dicdta_gst");
    }
    /**
     * @Route("admin/dicdta/gestion", name="dicdta_gst")
     */
    public function DicdtaListShow(TdicdtaRepository $tdicdtaRepository,  Request $request): Response
    {
        $search= new SearchBddChp;
        $form=$this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tsoc=$tdicdtaRepository->findWithSearch($search);
        }else{
            $tsoc = $tdicdtaRepository->findAll();
        }
        return $this->render('dicdta/dicdtaGst.html.twig', [
            'tsoc' => $tsoc,
            'form'=>$form->createView()

        ]);
    }
}

