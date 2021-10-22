<?php

namespace App\Controller;

use App\Entity\Tcategorie;
use App\Form\CtgCreatType;
use App\Form\CtgModifType;
use App\Repository\TcategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie/creat", name="ctg_creat")
     */
    public function categorieCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tcategorie = new Tcategorie;
        $tcategorie->setUsrIns($this->getUser());
        $tcategorie->setDatIns(new \DateTime('now'));

        $form = $this->createForm(CtgCreatType::class, $tcategorie);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tcategorie = $form->getData();

            $em->persist($tcategorie);
            $em->flush();
            return $this->redirectToRoute('ctg_gst');
        }
        return $this->render('/categorie/ctgCreat.html.twig', [
            'formView' => $form->createView()
        ]);
    }
    /**
     * @Route("/categorie/{id}/edit", name="ctg_modif")
     */
    public function categorieModif($id, TcategorieRepository $tcategorieRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tcategorie = $tcategorieRepository->findOneBy(['id' => $id]);
        $tcategorie->setUsrUpd($this->getUser());
        $tcategorie->setDatUpd(new \DateTime('now'));
        $form = $this->createForm(CtgModifType::class, $tcategorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('ctg_gst');
        }
        return $this->render('/categorie/ctgModif.html.twig', [
            'formView' => $form->createView(),
            'tcategorie' => $tcategorie
        ]);
    }
    /**
     * @Route("/categorie/gestion", name="ctg_gst")
     */
    public function commercialListShow(TcategorieRepository $tcategorieRepository): Response
    {
        $tcategorie = $tcategorieRepository->findAll();


        return $this->render('/categorie/ctgGst.html.twig', [
            'tcategorie' => $tcategorie,

        ]);
    }
}
