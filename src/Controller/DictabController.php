<?php

namespace App\Controller;

use App\Entity\Tdictab;
use App\Data\SearchData;
use App\Form\DictabType;
use App\recherche\Search;

use App\Form\DictionnaireType;


use App\Repository\TclientRepository;
use App\Repository\TdictabRepository;

use App\Repository\TarticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DictabController extends AbstractController
{
    /**
     * @Route("admin/dictab/creat", name="dictab_creat")
     */
    public function  DictabCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = new Tdictab;
        $tsoc->setUsrIns($this->getUser());
        $tsoc->setDatIns(new \DateTime('now'));

        $form01 = $this->createForm(DictabType::class,  $tsoc, [
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

            return $this->redirectToRoute('dictab_gst');
        } else {

            $this->addFlash("error", "Zones Famcli non renseignées");
        }

        return $this->render('dictab/dictabCM.html.twig', [
            'form' => $form01->createView(),
            'titre1' => 'Création ',
            'titre2' => 'Dictab',
        ]);
    }
    /**
     * @Route("admin/dictab/edit/{id}", name="dictab_modif")
     */
    public function SocieteModif($id, TdictabRepository $tdictabRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tsoc = $tdictabRepository->findOneBy(['id' => $id]);

        $form01 = $this->createForm(DictabType::class,   $tsoc, [
            'attr' => [
                'readonly' => true,
                'disabled' => false
            ],
        ]);

        $form01->handleRequest($request);
        if ($form01->isSubmitted() && $form01->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('dictab_gst');
        }
        return $this->render('dictab/dictabCM.html.twig', [
            'form' => $form01->createView(),
            'tfamcli' => $tsoc,
            'titre1' => 'Modification ',
            'titre2' => 'Dictab'

        ]);
    }
    /**
     * @Route("admin/dictab/supp/{id}", name="dictab_supp")
     */
    public function  DictabSupp($id, TdictabRepository $tdictabRepository,TclientRepository $tclientRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = $tdictabRepository->findOneBy(['id' => $id]);

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

        return $this->redirectToRoute("dictab_gst");
    }
    /**
     * @Route("admin/dictab/gestion", name="dictab_gst")
     */
    public function DictabListShow(TdictabRepository $tdictabRepository,  Request $request): Response
    {
      
            $tsoc = $tdictabRepository->findAll();

        return $this->render('dictab/dictabGst.html.twig', [
            'tsoc' => $tsoc,
            

        ]);
    }
}
