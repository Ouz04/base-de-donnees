<?php

namespace App\Controller;

use App\Form\UploadType;
use App\SpecClass\ItgRtr;
use App\Entity\Tuploadfil;
use App\Service\ItgArtfou;
use App\Service\FileUploader;
use App\Repository\TitgficettRepository;
use App\Repository\TitgficpstRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ItgficController extends AbstractController
{
    private $slugger;
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    /**
     * @Route("/mkt/itgfic/{cod}", name="itgfic_exe")
     */
    public function upload($cod, Request $request, EntityManagerInterface $em, FileUploader $fileUploader, ItgArtfou $itgArtfou, TitgficettRepository $titgficettRepository, TitgficpstRepository $titgficpstRepository, string $dataDirectory): Response
    {
        $itgRtr = new ItgRtr();
        // $tuploadfil = new Tuploadfil();
        $form = $this->createForm(UploadType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('nom')->getData();
            $info = new SplFileInfo($file, '', '');
            // dd($file->getClientOriginalName());

            //  dd($file->getOriginalName());
            $ficLcl = $file->getClientOriginalName();
            // $ficLcl = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $file->guessExtension();
            $ficItn = $fileUploader->upload($file);
            //      $tuploadfil->setNom($originalFilename . '.' . $file->guessExtension());

            $file = $dataDirectory . $ficItn;

            if (($handle = fopen($file, "r")) !== FALSE) {
                switch ($cod) {
                    case 'ARTFOU':

                        $itgRtr = $itgArtfou->itgExe($ficLcl, $ficItn, $this->getUser(), $handle);
                        //  dd($itgRtr);
                        break;

                    default:
                }
                fclose($handle);
            }
            if ($itgRtr->getId() > 0) {
                if ($itgRtr->getKO() == 0 && $itgRtr->getOK() == 0) {
                    $this->addFlash('warning', "aucune ligne à traiter");
                } elseif ($itgRtr->getKO() == 0 && $itgRtr->getOK() > 0) {
                    $this->addFlash('success', "$itgRtr->getOK() enregistrements intégrés");
                } else {
                    $this->addFlash('warning', $itgRtr->getOK() . '/' . $itgRtr->getOKKO() . ' enregistrements intégrés');
                }

                return $this->redirectToRoute('itgfic_crd', ['id' => $itgRtr->getId()]);
                // $titgficett = $titgficettRepository->findBy(['id' => $id]);
                // $titgficpst = $titgficpstRepository->findBy(['clrItgfic' => $id]);

                // return $this->render('itgfic/itgficCrd.html.twig', [
                //     'titgficett' => $titgficett,
                //     'titgficpst' => $titgficpst,
                // ]);
            } else {
                // dd('erreur');
                $this->addFlash('error', "L'intégration s'est interrompue");
                return $this->redirectToRoute('homepage');
            }


            // return $this->redirectToRoute('itgfic_crd', ['id' => 0]);
        }
        return $this->render('itgfic/itgficExe.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/mkt/itgfic/crd/{id}", name="itgfic_crd")
     */
    public function uploadCrd($id, Request $request, TitgficettRepository $titgficettRepository, TitgficpstRepository $titgficpstRepository): Response
    {
        $titgficett = $titgficettRepository->findOneBy(['id' => $id]);
        $titgficpst = $titgficpstRepository->findBy(['clrItgfic' => $id], ['num' => 'ASC']);
        // dd($titgficett);
        return $this->render('/itgfic/itgficCrd.html.twig', [
            'titgficett' => $titgficett,
            'titgficpst' => $titgficpst,
        ]);
    }
}
