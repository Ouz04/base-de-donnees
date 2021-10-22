<?php

namespace App\Controller;


use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\GtaettType;
use App\Entity\Tgritarett;
use App\Entity\Tgritarpst;
use App\Form\GtapstCMType;
use App\Repository\TclientRepository;
use App\Repository\TgritarettRepository;
use App\Repository\TgritarpstRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GritarController extends AbstractController
{
  
    /**
     * @Route("/cml/gritarettcli/creat/{id}", name="gtaettcli_creat")
     */
    public function gritarettcliCreat(int $id, TclientRepository $tclientRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tclient = $tclientRepository->findOneBy(['id' => $id]);

        $tgritarett = new Tgritarett;

        $tgritarett->setUsrIns($this->getUser());
        $tgritarett->setDatIns(new \DateTime('now'));

        $tgritarett->setClrCli($tclient);

        $form = $this->createForm(GtaettType::class, $tgritarett, ['attr' => ['readonly' => false]]);
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tgritar = $form->getData();

            $em->persist($tgritarett);
            $em->flush();
            return $this->redirectToRoute('gtaettcli_gst', ['id' => $tgritarett->getClrCli()->getId()]);
        }
        $idCli = $tgritarett->getClrCli()->getId();
        return $this->render('gritar/gtaettCM.html.twig', [
            'formView' => $form->createView(),
            'idCli' => $tgritarett->getClrCli()->getId(),
            'titre1' => 'Création ',
            'titre2' => 'grille tarifaire'

        ]);
    }
   
    /**
     * @Route("/cml/gritarettcli/edit/{id}", name="gtaettcli_modif")
     */
    public function gritarettcliModif($id, TgritarettRepository $tgritarettRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tgritarett = $tgritarettRepository->findOneBy(['id' => $id]);
        $tgritarett->setUsrUpd($this->getUser());
        $tgritarett->setDatUpd(new \DateTime('now'));
        $form = $this->createForm(GtaettType::class, $tgritarett, ['attr' => ['readonly' => true]]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form);

            $em->flush();

            return $this->redirectToRoute('gtaettcli_gst', ['id' => $tgritarett->getClrCli()->getId()]);
        }
        return $this->render('gritar/gtaettCM.html.twig', [
            'formView' => $form->createView(),
            'tgritarett' => $tgritarett,
            'idCli' => $tgritarett->getClrCli()->getId(),
            'titre1' => 'Modification ',
            'titre2' => 'grille tarifaire'


        ]);
    }
    /**
     * @Route("/cml/gritarett/supp/{id}", name="gtaett_supp")
     */
    public function gritarettSupp($id, TgritarettRepository $tgritarettRepository, TgritarpstRepository $tgritarpstRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tgritarett = $tgritarettRepository->findOneBy(['id' => $id]);
        $idCli = $tgritarett->getClrCli()->getId();

        if (!$tgritarett) {
            throw $this->createNotFoundException("La grille tarifaire $id n'existe pas et ne peut pas être supprimée");
        }
        $tgritarpst = $tgritarpstRepository->findBy(['clrGta' => $tgritarett->getId()]);
        if ($tgritarpst) {
            // throw $this->createNotFoundException("La cotation $id ne peut pas être supprimée car il y a au moins une liaison (cotcli)");
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (gritarpst) ');
        } else {
            $em->remove($tgritarett);
            $em->flush();
            $this->addFlash("success", "Enregistrement supprimé");
        }


        return $this->redirectToRoute("gtaettcli_gst", ['id' => $idCli]);
    }

    /**
     * @Route("/cml/gritarett/gestion", name="gtaett_gst")
     */
    public function gritarettLstGst(TgritarettRepository $tgritarettRepository): Response
    {
        $tgritarett = $tgritarettRepository->findAll();

        // if (!$tcotation) {
        //     throw $this->createNotFoundException("Erreur d'appel cotation X");
        // }
        return $this->render('/gritar/gtaettGst.html.twig', [
            'tgritarett' => $tgritarett,

        ]);
    }
    /**
     * @Route("/cml/gritarett/cli/gestion/{id}", name="gtaettcli_gst")
     */
    public function gritarettcliLstGst($id, TgritarettRepository $tgritarettRepository): Response
    {
        $tgritarett = $tgritarettRepository->findBy(['clrCli' => $id]);

        // if (!$tcotation) {
        //     throw $this->createNotFoundException("Erreur d'appel cotation X");
        // }
        return $this->render('/gritar/gtaettcliGst.html.twig', [
            'tgritarett' => $tgritarett,
            'idCli' => $id
        ]);
    }
    /**
     * @Route("/cml/gritarpst/{id}", name="gtapst_gst")
     */
    public function gritarpstListAff(int $id, TgritarpstRepository $tgritarpstRepository, TgritarettRepository $tgritarettRepository): Response
    {
        $tgritarett = $tgritarettRepository->findOneBy(['id' => $id]);
        $tgritarpst = $tgritarpstRepository->findBy(['clrGta' => $id], ['codArt' => 'ASC']);
        // if (!$tcotation) {
        //     throw $this->createNotFoundException("Erreur d'appel cotation X");
        // }
        return $this->render('/gritar/gtapstGst.html.twig', [
            'tgritarett' => $tgritarett,
            'tgritarpst' => $tgritarpst
        ]);
    }
    /**
     * @Route("/cml/gritarpst/creat/{idgta}", name="gtapst_creat")
     */
    public function gritarpstCreat($idgta, TgritarettRepository $tgritarettRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tgritarett = $tgritarettRepository->findOneBy(['id' => $idgta]);

        $tgritarpst = new Tgritarpst;

        $tgritarpst->setUsrIns($this->getUser());
        $tgritarpst->setDatIns(new \DateTime('now'));

        $tgritarpst->setClrGta($tgritarett);

        $form = $this->createForm(GtapstCMType::class, $tgritarpst, ['attr' => ['readonly' => false]]);
       
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tgritarpst = $form->getData();

            $em->persist($tgritarpst);
            $em->flush();
            return $this->redirectToRoute('gtapst_gst', ['id' => $tgritarett->getId()]);
        }
        // $idCli = $tgritarett->getClrCli()->getId();
      
        return $this->render('gritar/gtapstCreat.html.twig', [
            'form' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'ligne grille tarifaire',
            'tgritarett' => $tgritarett,
            
        ]);
    }

    /**
     * @Route("/cml/gritarpst/modif/{id}", name="gtapst_modif")
     */
    public function gritarpstModif($id, TgritarpstRepository $tgritarpstRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tgritarpst = $tgritarpstRepository->findOneBy(['id' => $id]);

        $tgritarett = $tgritarpst->getClrGta();
        $tgritarpst->setCodArtFrm($tgritarpst->getClrArt()->getCod());
        $tgritarpst->setCodCliFrm($tgritarett->getClrCli()->getCod());
        $tgritarpst->setUsrUpd($this->getUser());
        $tgritarpst->setDatUpd(new \DateTime('now'));

        $form = $this->createForm(GtapstCMType::class, $tgritarpst, ['attr' => ['readonly' => true]]);
    
        $form->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $tgritarpst = $form->getData();

            $em->persist($tgritarpst);
            $em->flush();
            return $this->redirectToRoute('gtapst_gst', ['id' => $tgritarpst->getClrGta()->getId()]);
        }
      
        return $this->render('gritar/gtapstCM.html.twig', [
            'form' => $form->createView(),
            'titre1' => 'Modification ',
            'titre2' => 'ligne grille tarifaire',
            'tgritarpst' => $tgritarpst,
            'tgritarett' => $tgritarett,
        ]);
    }
     /**
     * @Route("/cml/gritarpst/supp/{id}", name="gtapst_supp")
     */
    public function gritarpstSupp($id, TgritarpstRepository $tgritarpstRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tgritarpst = $tgritarpstRepository->findOneBy(['id' => $id]);


        if (!$tgritarpst) {
            throw $this->createNotFoundException("La grille tarifaire $id n'existe pas et ne peut pas être supprimée");
        }
        
            $em->remove($tgritarpst);
            $em->flush();
            $this->addFlash("success", "Enregistrement supprimé");
  


            return $this->redirectToRoute('gtapst_gst', ['id' => $tgritarpst->getClrGta()->getId()]);

       

    }
     /**
     * @Route("/cml/gritarpst/upload/{idgta}", name="gtapst_upload")
     */
    public function gritarpstUpload($idgta, TgritarettRepository $tgritarettRepository, Request $request, EntityManagerInterface $em): void
    {
    
    }
    /**
     * @Route("/cml/gritarpst/download/{id}", name="gtapst_download")
     */
    public function GritarpstDownload(int $id, TgritarpstRepository $tgritarpstRepository, TgritarettRepository $tgritarettRepository): Response
    {
        $tgritarett = $tgritarettRepository->findOneBy(['id' => $id]);
        $tgritarpst = $tgritarpstRepository->findBy(['clrGta' => $id], ['codArt' => 'ASC']);
        //dd( $tgritarett);
        $pdfOptions = new Options();
        // Police par défaut
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        // On instancie Dompdf
        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($context);

        // On génère le html
        $html = $this->renderView('gritar/imprimer.html.twig', [
            'tgritarett' => $tgritarett,
            'tgritarpst' => $tgritarpst
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        $fichier = 'tgritarpst-data-'. $tgritarett->getId() .'.pdf';

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);

        return new Response();
        
    }

}
