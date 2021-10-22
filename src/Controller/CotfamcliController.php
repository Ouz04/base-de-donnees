<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Tcotfamcli;

use App\Form\CotfamcliType;
use App\Form\SearchFormCotfamcli;
use App\Repository\TcotfamcliRepository;
use App\Repository\TgritarpstRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CotfamcliController extends AbstractController
{
    /**
     * @Route("/cotfamcli/creat", name="cotfamcli_creat")
     */
    public function cotfamcliCreat(Request $request, EntityManagerInterface $em, TcotfamcliRepository $tcotfamcliRepository): Response
    {
       
        $tcotfamcli = new Tcotfamcli;
        
        $form = $this->createForm(CotfamcliType::class, $tcotfamcli, ['attr' => ['readonly' => false, 'disabled' => false]]);
 
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {

            $tcotfamcli = $form->getData();
            $tcotfamcli->setUsrIns($this->getUser());
            $tcotfamcli->setDatIns(new \DateTime('now'));

            $tcotfamcli2 = $tcotfamcliRepository->findBy(['clrCot' => $tcotfamcli->getClrCot()->getId(), 'clrFamcli' => $tcotfamcli->getclrFamcli()->getId()]);
            if ($tcotfamcli2) {
                //dd("erreur");
                $this->addFlash("warning", 'Enregistrement non effectué : il existe un enregistrement avec le même code');
            } else {
                $em->persist($tcotfamcli);
                $em->flush();
                $this->addFlash("success", "Enregistrement ajouté");
            }
            return $this->redirectToRoute('cotfamcli_gst');
        }

        return $this->render('cotfamcli/cotfamcliCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'cotation-oganisation'

        ]);
    }
    /**
     * @Route("/cotfamcli/edit/{id}", name="cotfamcli_modif")
     */
    public function cotfamcliModif($id, TcotfamcliRepository $tcotfamcliRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tcotfamcli = $tcotfamcliRepository->findOneBy(['id' => $id]);
        $clrCot = $tcotfamcli->getClrCot();
        $clrFamcli = $tcotfamcli->getclrFamcli();

        $form = $this->createForm(cotfamcliType::class, $tcotfamcli, ['attr' => ['readonly' => true, 'disabled' => true]]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tcotfamcli->setClrCot($clrCot);
            $tcotfamcli->setclrFamcli($clrFamcli);
            $tcotfamcli->setUsrUpd($this->getUser());
            $tcotfamcli->setDatUpd(new \DateTime('now'));

            $em->flush();

            return $this->redirectToRoute('cotfamcli_gst');
        }
        return $this->render('cotfamcli/cotfamcliCM.html.twig', [
            'formView' => $form->createView(),
            'tcotfamcli' => $tcotfamcli,
            'titre1' => 'Modification ',
            'titre2' => 'cotation-organisation'

        ]);
    }
    /**
     * @Route("/cotfamcli/supp/{id}", name="cotfamcli_supp")
     */
    public function cotationSupp($id, TcotfamcliRepository $tcotfamcliRepository, TgritarpstRepository $tgritarpstRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tcotfamcli = $tcotfamcliRepository->findOneBy(['id' => $id]);

        if (!$tcotfamcli) {
            throw $this->createNotFoundException("La cotation-famille client $id n'existe pas et ne peut pas être supprimée");
       
        } else {

            $em->remove($tcotfamcli);
            $em->flush();
            $this->addFlash("success", "Enregistrement supprimé");
        }
        return $this->redirectToRoute("cotfamcli_gst");
    }
    /**
     * @Route("/cotfamcli/gestion", name="cotfamcli_gst")
     */
    public function cotfamcliLstGst(TcotfamcliRepository $cotfamcliRepository, Request $request): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormCotfamcli::class, $data);
        $form->handleRequest($request);

        $tcotfamcli = $cotfamcliRepository->findSearch($data);

        return $this->render('/cotfamcli/cotfamcliGst.html.twig', [
            'tcotfamcli' => $tcotfamcli,
            'form' => $form->createView(),

        ]);
    }
}
