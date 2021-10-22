<?php

namespace App\Controller;

use App\Entity\Tcotorg;
use App\Data\SearchData;
use App\Form\CotorgType;
use App\Form\SearchFormCotorg;
use App\Repository\TcotorgRepository;
use App\Repository\TgritarpstRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CotorgController extends AbstractController
{
    /**
     * @Route("/cotorg/creat", name="cotorg_creat")
     */
    public function cotorgCreat(Request $request, EntityManagerInterface $em, TcotorgRepository $tcotorgRepository): Response
    {
        $tcotorg = new Tcotorg;
        $form = $this->createForm(CotorgType::class, $tcotorg, ['attr' => ['readonly' => false, 'disabled' => false]]);
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {

            $tcotorg = $form->getData();
            $tcotorg->setUsrIns($this->getUser());
            $tcotorg->setDatIns(new \DateTime('now'));

            $tcotorg2 = $tcotorgRepository->findBy(['clrCot' => $tcotorg->getClrCot()->getId(), 'clrOrg' => $tcotorg->getClrOrg()->getId()]);
            if ($tcotorg2) {
                //dd("erreur");
                $this->addFlash("warning", 'Enregistrement non effectué : il existe un enregistrement avec le même code');
            } else {
                $em->persist($tcotorg);
                $em->flush();
                $this->addFlash("success", "Enregistrement ajouté");
            }
            return $this->redirectToRoute('cotorg_gst');
        }
        return $this->render('cotorg/cotorgCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'cotation-oganisation'

        ]);
    }
    /**
     * @Route("/cotorg/edit/{id}", name="cotorg_modif")
     */
    public function cotorgModif($id, TcotorgRepository $tcotorgRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tcotorg = $tcotorgRepository->findOneBy(['id' => $id]);
        $clrCot = $tcotorg->getClrCot();
        $clrOrg = $tcotorg->getClrOrg();

        $form = $this->createForm(CotorgType::class, $tcotorg, ['attr' => ['readonly' => true, 'disabled' => true]]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tcotorg->setClrCot($clrCot);
            $tcotorg->setClrOrg($clrOrg);
            $tcotorg->setUsrUpd($this->getUser());
            $tcotorg->setDatUpd(new \DateTime('now'));

            $em->flush();

            return $this->redirectToRoute('cotorg_gst');
        }
        return $this->render('cotorg/cotorgCM.html.twig', [
            'formView' => $form->createView(),
            'tcotorg' => $tcotorg,
            'titre1' => 'Modification ',
            'titre2' => 'cotation-organisation'

        ]);
    }
    /**
     * @Route("/cotorg/supp/{id}", name="cotorg_supp")
     */
    public function cotationSupp($id, TcotorgRepository $tcotorgRepository, TgritarpstRepository $tgritarpstRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tcotorg = $tcotorgRepository->findOneBy(['id' => $id]);

        if (!$tcotorg) {
            throw $this->createNotFoundException("La cotation-organisation $id n'existe pas et ne peut pas être supprimée");
        }
        $tgritarpst = $tgritarpstRepository->findBy(['clrCotorg' => $tcotorg->getId()]);
        if ($tgritarpst) {
            // throw $this->createNotFoundException("La cotation $id ne peut pas être supprimée car il y a au moins une liaison (cotorg)");
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (tgritarpst) ');
        } else {

            $em->remove($tcotorg);
            $em->flush();
            $this->addFlash("success", "Enregistrement supprimé");
        }
        return $this->redirectToRoute("cotorg_gst");
    }
    /**
     * @Route("/cotorg/gestion", name="cotorg_gst")
     */
    public function cotorgLstGst(TcotorgRepository $cotorgRepository, Request $request): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormCotorg::class, $data);
        $form->handleRequest($request);

        $tcotorg = $cotorgRepository->findSearch($data);

        return $this->render('/cotorg/cotorgGst.html.twig', [
            'tcotorg' => $tcotorg,
            'form' => $form->createView(),

        ]);
    }
}
