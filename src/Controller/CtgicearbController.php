<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\CtgiceType;
use App\Entity\Tctgicearb;
use App\Entity\Tctgiceniv;
use App\Form\CtgicearbType;
use App\Form\SearchFormCtgice;
use App\Form\SearchFormCtgicearb;
use App\Repository\TarticleRepository;
use App\Repository\TctgicearbRepository;
use App\Repository\TctgicenivRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CtgicearbController extends AbstractController
{
    /**
     * @Route("/mkt/ctgicearb/creat", name="ctgicearb_creat")
     */
    public function ctgicearbCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tctgicearb = new Tctgicearb;
        $tctgicearb->setUsrIns($this->getUser());
        $tctgicearb->setDatIns(new \DateTime('now'));

        $form = $this->createForm(CtgicearbType::class, $tctgicearb, ['attr' => ['readonly' => false]]);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
             $form->get('nbreActicles')->getData();

            $em->persist($tctgicearb);
            $em->flush();
            return $this->redirectToRoute('ctgicearb_gst');
        }
        return $this->render('/ctgicearb/ctgicearbCM.html.twig', [
            'form' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'catégorie'

        ]);
    }
    /**
     * @Route("/mkt/ctgicearb/edit/{id}", name="ctgicearb_modif")
     */
    public function ctgicearbModif($id, TctgicearbRepository $tctgicearbRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tctgicearb = $tctgicearbRepository->findOneBy(['id' => $id]);

        $tctgicearb->setDatUpd(new \DateTime('now'));
        $tctgicearb->setUsrUpd($this->getUser());
        $form = $this->createForm(CtgicearbType::class, $tctgicearb, ['attr' => ['readonly' => true]]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('ctgicearb_gst');
        }
        return $this->render('/ctgicearb/ctgicearbCM.html.twig', [
            'form' => $form->createView(),
            'tctgicearb' => $tctgicearb,
            'titre1' => 'Modification ',
            'titre2' => 'catégorie'
        ]);
    }
    /**
     * @Route("/mkt/ctgicearb/supp/{id}", name="ctgicearb_supp")
     */
    public function ctgicearbSupp($id, TctgicearbRepository $tctgicearbRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tctgicearb = $tctgicearbRepository->findOneBy(['id' => $id]);

        if (!$tctgicearb) {
            throw $this->createNotFoundException("La catégorie $id n'existe pas et ne peut pas être supprimée");
        }
        $tarticle = $tarticleRepository->findBy(['clrCtgice' => $tctgicearb]);
        if ($tarticle) {
            throw $this->createNotFoundException("La catégorie $id ne peut pas être supprimée car il y a au moins un article lié");
        }
        $em->remove($tctgicearb);
        $em->flush();
        $this->addFlash("success", "Enregistrement supprimé");

        return $this->redirectToRoute("ctgice_gst");
    }
    /**
     * @Route("/mkt/ctgicearb/gestion", name="ctgicearb_gst")
     */
    public function ctgicearbLstGst(TctgicearbRepository $tctgicearbRepository, Request $request,PaginatorInterface $paginator): Response
    {
       
        $data = new SearchData;
        $form = $this->createForm(SearchFormCtgicearb::class, $data);
        $form->handleRequest($request);
        $page = (int)$request->query->getInt('page', 1);
        $limit = 20;
        $liste = $tctgicearbRepository->findSearch($data);
         $tctgicearb=$paginator->paginate(
            $liste,
            $page,
           $limit
        );
        
        
        //$tctgicearb = $tctgicearbRepository->findAll();
        ini_set('memory_limit', '-1');
        return $this->render('/ctgicearb/ctgicearbGst.html.twig', [
            'form' => $form->createView(),
            'tctgicearb' => $tctgicearb,


        ]);
    }
    
}

