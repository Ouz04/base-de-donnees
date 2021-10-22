<?php

namespace App\Controller;

use DateTime;
use App\Form\CotType;
use App\Data\SearchData;
use App\Entity\Tcotation;
use App\Form\SearchFormCot;
use App\Repository\TartcotRepository;
use App\Repository\TcotorgRepository;
use App\Repository\TarticleRepository;
use App\Repository\TcotationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CotationController extends AbstractController
{
    /**
     * @Route("/cotation/creat", name="cot_creat")
     */
    public function cotationCreat(Request $request, EntityManagerInterface $em, TcotationRepository $tcotationRepository): Response
    {
        $tcotation = new Tcotation;
        $tcotation->setUsrIns($this->getUser());
        $tcotation->setDatIns(new \DateTime('now'));

        $form = $this->createForm(CotType::class, $tcotation, ['attr' => ['readonly' => false]]);
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {
            $tcotation = $form->getData();
            // on verifie si cod pas déjà existant
            $tcotation2 = $tcotationRepository->findBy(['cod' => $tcotation->getCod()]);
            if ($tcotation2) {
                //dd("erreur");
                $this->addFlash("warning", 'Enregistrement non effectué : il existe un enregistrement avec le même code');
            } else {
                $em->persist($tcotation);
                $em->flush();
                $this->addFlash("success", "Enregistrement ajouté");
                return $this->redirectToRoute('cot_gst');
            }
        }
        return $this->render('cotation/cotCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'cotation',
            'action'=>'01'

        ]);
    }
    /**
     * @Route("/cotation/edit/{id}", name="cot_modif")
     */
    public function cotationModif($id, TcotationRepository $tcotationRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tcotation = $tcotationRepository->findOneBy(['id' => $id]);
        $tcotation->setUsrUpd($this->getUser());
        $tcotation->setDatUpd(new \DateTime('now'));
        $form = $this->createForm(CotType::class, $tcotation, ['attr' => ['readonly' => true]]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $product = $form->getData();

            $em->flush();
            $this->addFlash("success", "Enregistrement modifié");
            return $this->redirectToRoute('cot_gst');
        }
        return $this->render('cotation/cotCM.html.twig', [
            'formView' => $form->createView(),
            'tcotation' => $tcotation,
            'titre1' => 'Modification ',
            'titre2' => 'cotation',
            'action'=>'02'

        ]);
    }
     /**
     * @Route("/cotation/aff/{id}", name="cot_aff")
     */
    public function cotationAff($id, TcotationRepository $tcotationRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tcotation = $tcotationRepository->findOneBy(['id' => $id]);
        $tcotation->setUsrUpd($this->getUser());
        $tcotation->setDatUpd(new \DateTime('now'));
        $form = $this->createForm(CotType::class, $tcotation, ['attr' => ['readonly' => true]]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $product = $form->getData();

            // $em->flush();
            // $this->addFlash("success", "Enregistrement modifié");
            // return $this->redirectToRoute('cot_gst');
        }
        return $this->render('cotation/cotCM.html.twig', [
            'formView' => $form->createView(),
            'tcotation' => $tcotation,
            'titre1' => 'Modification ',
            'titre2' => 'cotation',
            'action'=>'03'

        ]);
    }
    /**
     * @Route("/cotation/supp/{id}", name="cot_supp")
     */
    public function cotationSupp($id, TcotationRepository $tcotationRepository, TcotorgRepository $tcotorgRepository, TartcotRepository $tartcotRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tcotation = $tcotationRepository->findOneBy(['id' => $id]);

        if (!$tcotation) {
            throw $this->createNotFoundException("La cotation $id n'existe pas et ne peut pas être supprimée");
        }
        $tcotorg = $tcotorgRepository->findBy(['clrCot' => $tcotation->getId()]);
        if ($tcotorg) {
            // throw $this->createNotFoundException("La cotation $id ne peut pas être supprimée car il y a au moins une liaison (cotorg)");
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (cotorg) ');
        } else {
            $tarcot = $tartcotRepository->findBy(['clrCot' => $tcotation->getId()]);
            if ($tarcot) {
                $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (artcot) ');
                //   throw $this->createNotFoundException("La cotation $id ne peut pas être supprimée car il y a au moins une liaison(artcot)");
            } else {
                $em->remove($tcotation);
                $em->flush();
                $this->addFlash("success", "Enregistrement supprimé");
            }
        }

        return $this->redirectToRoute("cot_gst");
    }
    /**
     * @Route("/cotation/gestion", name="cot_gst")
     */
    public function cotationLstGst(TcotationRepository $tcotationRepository, Request $request): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormCot::class, $data);
        $form->handleRequest($request);
        $tcotation = $tcotationRepository->findSearch($data);

        return $this->render('/cotation/cotGst.html.twig', [
            'tcotation' => $tcotation,
            'form' => $form->createView(),

        ]);
    }
}
