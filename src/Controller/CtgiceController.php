<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\CtgiceType;
use App\Entity\Tctgiceniv;
use App\Form\SearchFormCtgice;
use App\Repository\TarticleRepository;
use App\Repository\TctgicenivRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CtgiceController extends AbstractController
{
    /**
     * @Route("/mkt/ctgice/creat", name="ctgice_creat")
     */
    public function ctgiceCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tctgiceniv = new Tctgiceniv;
        $tctgiceniv->setUsrIns($this->getUser());
        $tctgiceniv->setDatIns(new \DateTime('now'));

        $form = $this->createForm(CtgiceType::class, $tctgiceniv, ['attr' => ['readonly' => false]]);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tcategorie = $form->getData();

            $em->persist($tctgiceniv);
            $em->flush();
            return $this->redirectToRoute('ctgice_gst');
        }
        return $this->render('/ctgice/ctgiceCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'catégorie'

        ]);
    }
    /**
     * @Route("/mkt/ctgice/edit/{id}", name="ctgice_modif")
     */
    public function ctgiceModif($id, TctgicenivRepository $tctgicenivRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tctgiceniv = $tctgicenivRepository->findOneBy(['id' => $id]);

        $tctgiceniv->setDatUpd(new \DateTime('now'));
        $tctgiceniv->setUsrUpd($this->getUser());
        $form = $this->createForm(CtgiceType::class, $tctgiceniv, ['attr' => ['readonly' => true]]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('ctgice_gst');
        }
        return $this->render('/ctgice/ctgiceCM.html.twig', [
            'formView' => $form->createView(),
            'tctgiceniv' => $tctgiceniv,
            'titre1' => 'Modification ',
            'titre2' => 'catégorie'
        ]);
    }
    /**
     * @Route("/mkt/ctgice/supp/{id}", name="ctgice_supp")
     */
    public function ctgiceSupp($id, TctgicenivRepository $tctgicenivRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tctgiceniv = $tctgicenivRepository->findOneBy(['id' => $id]);

        if (!$tctgiceniv) {
            throw $this->createNotFoundException("La catégorie $id n'existe pas et ne peut pas être supprimée");
        }
        $tarticle = $tarticleRepository->findBy(['clrCtgice' => $tctgiceniv]);
        if ($tarticle) {
            throw $this->createNotFoundException("La catégorie $id ne peut pas être supprimée car il y a au moins un article lié");
        }
        $em->remove($tctgiceniv);
        $em->flush();
        $this->addFlash("success", "Enregistrement supprimé");

        return $this->redirectToRoute("ctgice_gst");
    }
    /**
     * @Route("/mkt/ctgice/gestion", name="ctgice_gst")
     */
    public function ctgiceLstGst(PaginatorInterface $paginator, TctgicenivRepository $tctgicenivRepository, Request $request): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormCtgice::class, $data);
        $form->handleRequest($request);
        $liste = $tctgicenivRepository->findSearch($data);
        $page = (int)$request->query->getInt('page', 1);
        $limit = 20;
        $tctgiceniv=$paginator->paginate(
            $liste,
            $page,
            $limit

        );


        return $this->render('/ctgice/ctgiceGst.html.twig', [
            'form' => $form->createView(),
            'tctgiceniv' => $tctgiceniv,


        ]);
    }
    
}
