<?php

namespace App\Controller;

use App\Entity\Tcotcli;
use App\Data\SearchData;
use App\Form\CotcliType;
use App\Form\SearchFormCotcli;
use App\Repository\TcotcliRepository;
use App\Repository\TgritarpstRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CotcliController extends AbstractController
{
    /**
     * @Route("/cotcli/creat", name="cotcli_creat")
     */
    public function cotcliCreat(Request $request, EntityManagerInterface $em, TcotcliRepository $tcotcliRepository): Response
    {
        $tcotcli = new Tcotcli;
        $form = $this->createForm(cotcliType::class, $tcotcli, ['attr' => ['readonly' => false, 'disabled' => false]]);
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {

            $tcotcli = $form->getData();
            $tcotcli->setUsrIns($this->getUser());
            $tcotcli->setDatIns(new \DateTime('now'));

            $tcotcli2 = $tcotcliRepository->findBy(['clrCot' => $tcotcli->getClrCot()->getId(), 'clrCli' => $tcotcli->getClrCli()->getId()]);
            if ($tcotcli2) {
                //dd("erreur");
                $this->addFlash("warning", 'Enregistrement non effectué : il existe un enregistrement avec le même code');
            } else {
                $em->persist($tcotcli);
                $em->flush();
                $this->addFlash("success", "Enregistrement ajouté");
            }
            return $this->redirectToRoute('cotcli_gst');
        }
        return $this->render('cotcli/cotcliCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'cotation-oganisation'

        ]);
    }
    /**
     * @Route("/cotcli/edit/{id}", name="cotcli_modif")
     */
    public function cotcliModif($id, TcotcliRepository $tcotcliRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tcotcli = $tcotcliRepository->findOneBy(['id' => $id]);
        $clrCot = $tcotcli->getClrCot();
        $clrOrg = $tcotcli->getClrcli();

        $form = $this->createForm(cotcliType::class, $tcotcli, ['attr' => ['readonly' => true, 'disabled' => true]]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tcotcli->setClrCot($clrCot);
            $tcotcli->setClrcli($clrOrg);
            $tcotcli->setUsrUpd($this->getUser());
            $tcotcli->setDatUpd(new \DateTime('now'));

            $em->flush();

            return $this->redirectToRoute('cotcli_gst');
        }
        return $this->render('cotcli/cotcliCM.html.twig', [
            'formView' => $form->createView(),
            'tcotcli' => $tcotcli,
            'titre1' => 'Modification ',
            'titre2' => 'cotation-organisation'

        ]);
    }
    /**
     * @Route("/cotcli/supp/{id}", name="cotcli_supp")
     */
    public function cotationSupp($id, TcotcliRepository $tcotcliRepository, TgritarpstRepository $tgritarpstRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tcotcli = $tcotcliRepository->findOneBy(['id' => $id]);

        if (!$tcotcli) {
            throw $this->createNotFoundException("La cotation-client $id n'existe pas et ne peut pas être supprimée");
        }
        $tgritarpst = $tgritarpstRepository->findBy(['clrcotcli' => $tcotcli->getId()]);
        if ($tgritarpst) {
            // throw $this->createNotFoundException("La cotation $id ne peut pas être supprimée car il y a au moins une liaison (cotcli)");
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (tgritarpst) ');
        } else {

            $em->remove($tcotcli);
            $em->flush();
            $this->addFlash("success", "Enregistrement supprimé");
        }
        return $this->redirectToRoute("cotcli_gst");
    }
    /**
     * @Route("/cotcli/gestion", name="cotcli_gst")
     */
    public function cotcliLstGst(TcotcliRepository $tcotcliRepository, Request $request): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormCotcli::class, $data);
        $form->handleRequest($request);

        $tcotcli = $tcotcliRepository->findSearch($data);

        return $this->render('/cotcli/cotcliGst.html.twig', [
            'tcotcli' => $tcotcli,
            'form' => $form->createView(),

        ]);
    }
}
