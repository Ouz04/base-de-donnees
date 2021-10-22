<?php

namespace App\Controller;

use App\Entity\Tartfou;
use App\Data\SearchData;
use App\Entity\Tarticle;
use App\Entity\Tarttrfsitweb;
use App\SpecClass\Reponse;
use App\Data\ArttrfsitwebData;
use App\Form\ArttrfsitwebType;
use App\Form\SearchFormArt;
use App\Repository\TartfouRepository;
use App\Repository\TarticleRepository;
use App\Repository\TarttrfsitwebRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArttrfsitwebController extends AbstractController
{
    // private $tartfouForm;

    /**
     * @Route("/mkt/arttrfsitweb/supp/{id}", name="arttrfsitweb_supp")
     */
    public function arttrfsitwebSupp($id, TarttrfsitwebRepository $tarttrfsitwebRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tarttrfsitweb = $tarttrfsitwebRepository->findOneBy(['id' => $id]);

        if (!$tarttrfsitweb) {
            throw $this->createNotFoundException("L'article en attente de transfert' $id n'existe pas et ne peut pas être supprimé");
        }

        $em->remove($tarttrfsitweb);
        $em->flush();
        $this->addFlash("success", "Enregistrement supprimé");


        return $this->redirectToRoute("arttrfsitweb_gst");
    }
    /**
     * @Route("/mkt/arttrfsitweb", name="arttrfsitweb_gst")
     */
    public function arttrfsitwebGst(TarticleRepository $articleRepository, TarttrfsitwebRepository $tarttrfsitwebRepository, TartfouRepository $tartfouRepository, Request $request): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormArt::class, $data, ['allow_extra_fields' => '00']);
        $form->handleRequest($request);

        $reponse = new Reponse;
        $maxResult = 2;
        $tarticle = $articleRepository->findSearch($data, $maxResult, $reponse);
        $tarttrfsitweb = $tarttrfsitwebRepository->findBy(['xTrf' => false]);
        $nb = count($tarticle);
        $reponse->setVar01('OK');
        include "shared/_flashFiltre.txt";


        return $this->render('/arttrfsitweb/arttrfsitwebGst.html.twig', [
            'tarticle' => $tarticle,
            'tarttrfsitweb' => $tarttrfsitweb,
            'form' => $form->createView(),
            'allow_extra_fields' => '00'
        ]);
    }
    /**
     * @Route("/ach/arttrfsitweb/ajt/{id}", name="arttrfsitweb_ajt")
     */
    public function arttrfsitwebAjt($id, TarticleRepository $articleRepository, TarttrfsitwebRepository $tarttrfsitwebRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tarttrfsitwebRch = $tarttrfsitwebRepository->findBy(['clrArt' => $id, 'xTrf' => false]);
        $article = $articleRepository->findOneBy(['id' => $id]);
        if (!$tarttrfsitwebRch) {
            $tarttrfsitweb = new Tarttrfsitweb();
            $tarttrfsitweb->setUsrIns($this->getUser());
            $tarttrfsitweb->setDatIns(new \DateTime('now'));
            $tarttrfsitweb->setClrArt($article);
            $tarttrfsitweb->setXTrf(false);
            $em->persist($tarttrfsitweb);
            $em->flush();
            $this->addFlash("Success", "L'article a été ajouté dans la liste d'attente de transfert ");
        } else {
            $this->addFlash("warning", "L'article existe déjà dans la liste d'attente de transfert ");
        }
        return $this->redirectToRoute('arttrfsitweb_gst');
    }
    /**
     * @Route("/ach/arttrfsitweb/trffic", name="arttrfsitweb_trffic")
     */
    public function arttrfsitwebTrfFic(TarttrfsitwebRepository $tarttrfsitwebRepository, TartfouRepository $tartfouRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tarttrfsitwebRch = $tarttrfsitwebRepository->findBy(['xTrf' => false, 'xCpl' => true]);
        $tabData = [];
        $tabDataSite = [];
        // creation ligne
        $i = 0;
        $j = 0;
        foreach ($tarttrfsitwebRch as $tab) {
            // E

            // $em->persist($tarticle);
            $tab->setXTrf(true);
            $em->persist($tab);
        }
        $em->flush();
        // dd($tabData);
        // $this->writeFile('\\\\X3TEST\\reprises\article\\', 'itm01', $tabData);
        // $this->writeFile('\\\\X3TEST\\reprises\article\\', 'itf01', $tabDataSite);


        $this->addFlash("success", "Les fichiers d'extraction sont générés ");
        return $this->redirectToRoute('arttrfsitweb_gst');
    }
    public function writeFile($path, $filename, $tdata): void
    {
        $filename = $path . $filename . '_' . date('YmdHis') . '.csv';
        $fp = fopen($filename, 'w');
        foreach ($tdata as $data) {
            $data = $data . "\n";

            fwrite($fp, $data);
        }


        fclose($fp);
    }
}
