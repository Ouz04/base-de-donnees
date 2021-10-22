<?php

namespace App\Controller;

use App\Entity\Tartfou;
use App\Data\SearchData;
use App\Entity\Tarticle;
use App\Entity\Tarttrfadx;
use App\SpecClass\Reponse;
use App\Data\ArttrfadxData;
use App\Form\ArttrfadxType;
use App\Form\SearchFormArt;
use App\Repository\TartfouRepository;
use App\Repository\TarticleRepository;
use App\Repository\TarttrfadxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArttrfadxController extends AbstractController
{
    private $tartfouForm;
    /**
     * @Route("/ach/arttrfadx/creat", name="arttrfadx_creat")
     */
    public function arttrfadxCreat(Request $request, TarticleRepository $tarticleRepository, EntityManagerInterface $em): Response
    {
        $data = new ArttrfadxData;

        $form = $this->createForm(ArttrfadxType::class, $data, [
            'attr' => [
                'readonly' => false,
                'disabled' => false
            ],
        ]);

        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {
            // verification que code article n'existe pas déjà
            $tart = $tarticleRepository->findBy(['cod' => $data->getCod()]);
            if ($tart) {
                $this->addFlash("warning", "Il existe déjà un article avec le même code. La création est impossible");
            } else {
                // $Tarticle = $form->getData();
                $tarticle = new Tarticle();
                $tartfou = new Tartfou();
                //$tarticle = $form->getData();
                $this->fillSaveForm($tarticle, $data, $tartfou, $em);

                $tarticle->setUsrIns($this->getUser());
                $tarticle->setDatIns(new \DateTime('now'));
                $tarticle->setXAct(true);
                $em->persist($tarticle);

                $tarttrfadx = new Tarttrfadx();
                $tarttrfadx->setClrArt($tarticle);
                $tarttrfadx->setXTrf(false);
                $tarttrfadx->setXCpl(true);
                $tarttrfadx->setUsrIns($this->getUser());
                $tarttrfadx->setDatIns(new \DateTime('now'));
                $em->persist($tarttrfadx);

                $em->flush();

                return $this->redirectToRoute('arttrfadx_gst');
            }
        }
        return $this->render('arttrfadx/arttrfadxCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'article'

        ]);
    }
    /**
     * @Route("/ach/arttrfadx/edit/{id}", name="arttrfadx_modif")
     */
    public function arttrfadxModif($id, TarttrfadxRepository $tarttrfadxRepository, TarticleRepository $tarticleRepository, TartfouRepository $tartfouRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tarttrfadx = $tarttrfadxRepository->findOneBy(['id' => $id]);
        $idArt = $tarttrfadx->getClrArt()->getId();
        $tarticle = $tarticleRepository->findOneBy(['id' => $idArt]);
        $tartfou = $tartfouRepository->findBy(['clrArt' => $idArt, 'xEnrTrfAdx' => true], ['prt' => 'ASC']);
        $data = new ArttrfadxData;
        $this->fillData($tarticle, $data, $tartfou);

        $form = $this->createForm(ArttrfadxType::class, $data, [
            'attr' => [
                'readonly' => true,
                'disabled' => false,
            ],
        ]);
        $form->handleRequest($request);
        //  dump($data);
        if ($form->isSubmitted() && $form->isValid()) {
            $Tarticle = $form->getData();
            $this->fillSaveForm($tarticle, $data, $tartfou, $em);
            $tarticle->setUsrUpd($this->getUser());
            $tarticle->setDatUpd(new \DateTime('now'));

            $em->persist($tarticle);

            $tarttrfadx->setUsrUpd($this->getUser());
            $tarttrfadx->setDatUpd(new \DateTime('now'));
            $tarttrfadx->setXCpl(true);
            $em->persist($tarttrfadx);

            $em->flush();

            return $this->redirectToRoute('arttrfadx_gst');
        }

        return $this->render('arttrfadx/arttrfadxCM.html.twig', [
            'formView' => $form->createView(),
            'tarticle' => $tarticle,
            'titre1' => 'Modification ',
            'titre2' => 'article'

        ]);
    }
    /**
     * @Route("/ach/arttrfadx/supp/{id}", name="arttrfadx_supp")
     */
    public function arttrfadxSupp($id, TarttrfadxRepository $tarttrfadxRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tarttrfadx = $tarttrfadxRepository->findOneBy(['id' => $id]);

        if (!$tarttrfadx) {
            throw $this->createNotFoundException("L'article en attente de transfert' $id n'existe pas et ne peut pas être supprimé");
        }

        $em->remove($tarttrfadx);
        $em->flush();
        $this->addFlash("success", "Enregistrement supprimé");


        return $this->redirectToRoute("arttrfadx_gst");
    }
    /**
     * @Route("/ach/arttrfadx", name="arttrfadx_gst")
     */
    public function arttrfadxGst(TarticleRepository $articleRepository, TarttrfadxRepository $tarttrfadxRepository, TartfouRepository $tartfouRepository, Request $request): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormArt::class, $data, ['allow_extra_fields' => '00']);
        $form->handleRequest($request);

        $reponse = new Reponse;
        $maxResult = 2;
        $tarticle = $articleRepository->findSearch($data, $maxResult, $reponse);
        $tarttrfadx = $tarttrfadxRepository->findBy(['xTrf' => false]);
        $tartfou = $tartfouRepository->findBy(['xEnrTrfAdx' => true]);
        $nb = count($tarticle);
        $reponse->setVar01('OK');
        include "shared/_flashFiltre.txt";

        // $nb = count($tarticle);
        // if ($nb == $maxResult) {
        //     $this->addFlash("warning", "Attention : tous les articles issus de la recherche ne sont pas affichés. C'est limité à " . $maxResult);
        // } elseif ($reponse->getVar01() == 'KO') {
        //     $this->addFlash("info", "Veuillez remplir le filtre pour la sélection d'article");
        // }
        return $this->render('/arttrfadx/arttrfadxGst.html.twig', [
            'tarticle' => $tarticle,
            'tarttrfadx' => $tarttrfadx,
            'tartfou' => $tartfou,
            'form' => $form->createView(),
            'allow_extra_fields' => '00'
        ]);
    }
    /**
     * @Route("/ach/arttrfadx/ajt/{id}", name="arttrfadx_ajt")
     */
    public function arttrfadxAjt($id, TarticleRepository $articleRepository, TarttrfadxRepository $tarttrfadxRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tarttrfadxRch = $tarttrfadxRepository->findBy(['clrArt' => $id, 'xTrf' => false]);
        $article = $articleRepository->findOneBy(['id' => $id]);
        if (!$tarttrfadxRch) {
            $tarttrfadx = new Tarttrfadx();
            $tarttrfadx->setUsrIns($this->getUser());
            $tarttrfadx->setDatIns(new \DateTime('now'));
            $tarttrfadx->setClrArt($article);
            $tarttrfadx->setXTrf(false);
            $tarttrfadx->setXCpl(false);
            $em->persist($tarttrfadx);
            $em->flush();
            $this->addFlash("Success", "L'article a été ajouté dans la liste d'attente de transfert ");
        } else {
            $this->addFlash("warning", "L'article existe déjà dans la liste d'attente de transfert ");
        }
        return $this->redirectToRoute('arttrfadx_gst');
    }
    /**
     * @Route("/ach/arttrfadx/trffic", name="arttrfadx_trffic")
     */
    public function arttrfadxTrfFic(TarttrfadxRepository $tarttrfadxRepository, TartfouRepository $tartfouRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tarttrfadxRch = $tarttrfadxRepository->findBy(['xTrf' => false, 'xCpl' => true]);
        $tabData = [];
        $tabDataSite = [];
        // creation ligne
        $i = 0;
        $j = 0;
        foreach ($tarttrfadxRch as $tab) {
            // E
            $tabData[$i] = 'E;' .  $tab->getClrArt()->getCod() . ';' . $tab->getClrArt()->getCtgAdx() . ';' . $tab->getClrArt()->getClrSitPrpAdx()->getCod() . ';';
            $tabData[$i] = $tabData[$i] . $tab->getClrArt()->getCodArtAncAdx() . ';1;"' . $tab->getClrArt()->getLib01Adx() . '";"' . $tab->getClrArt()->getLib01Adx() . '";"';
            $tabData[$i] = $tabData[$i] . $tab->getClrArt()->getLib02Adx() . '";"' . $tab->getClrArt()->getLib03Adx() . '";'  . $tab->getClrArt()->getCleRchAdx() . ';';
            $tabData[$i] = $tabData[$i] . $tab->getClrArt()->getCodEan() . ';' . $tab->getClrArt()->getNrmAdx() . ';' . $tab->getClrArt()->getClrApcAdx()->getCod() . ';';
            $Famniv1Adx = '';
            if ($tab->getClrArt()->getClrFamniv1Adx()) {
                $Famniv1Adx = $tab->getClrArt()->getClrFamniv1Adx()->getCod();
            }
            $Famniv2Adx = '';
            if ($tab->getClrArt()->getClrFamniv2Adx()) {
                $Famniv2Adx = $tab->getClrArt()->getClrFamniv2Adx()->getCod();
            }
            $Famniv3Adx = '';
            if ($tab->getClrArt()->getClrFamniv3Adx()) {
                $Famniv3Adx = $tab->getClrArt()->getClrFamniv3Adx()->getCod();
            }
            $tabData[$i] = $tabData[$i] . $Famniv1Adx  . ';'   . $Famniv2Adx . ';'   . $Famniv3Adx . ';;';
            // code comptable
            $tabData[$i] = $tabData[$i] . $tab->getClrArt()->getPdsUnt() . ';' . $tab->getClrArt()->getPds() . ';' . $tab->getClrArt()->getClrCodCtaAdx()->getCod() . ';' . $tab->getClrArt()->getClrNivTaxAdx()->getCod() . ';1;ZDEM;1;';
            // acheteur
            $tabData[$i] = $tabData[$i] .  $tab->getClrArt()->getClrAhrAdx()->getCod();
            $i++;
            $tabData[$i] = 'M;'  . $tab->getClrArt()->getPrxBasAdx() . ';' . $tab->getClrArt()->getMrgMinAdx() . ';';

            $i++;
            // N : fournisseur
            $tartfou = $tartfouRepository->findBy(['clrArt' => $tab->getClrArt(), 'xEnrTrfAdx' => true]);
            foreach ($tartfou as $artfou) {
                // fournisseur
                // article fournisseur
                // désignation fournisseur
                // priorite
                // qté minimum achat
                // unité achat : UC
                // coef UA-US : 1
                // conditionnement : vide
                // coef UC/UA : 1
                // Contremarque : non coché : 1, coché 2
                // blocage : 1
                // soumis à contrôle : 1

                if ($artfou->getClrFou()->getCodAdx() != '') {
                    $fou = $artfou->getClrFou()->getCodAdx();
                } else {

                    $fou = $artfou->getClrFou()->getCod();
                }
                $tabData[$i] = 'N;'  .  $fou . ';' . $artfou->getClrArt()->getCod()  . ';' .  $artfou->getClrArt()->getLib01Adx() . ';';
                $xCntMrq = (int)$artfou->getXCntmrq() + 1;
                $tabData[$i] = $tabData[$i] .  $artfou->getPrt() . ';' . $artfou->getQteMin() . ';UC;1;;;1;' . $xCntMrq . ';1;1;';
                $i++;
            }
            // site
            if ($tab->getClrArt()->getClrSitStk01Adx()) {
                // code article
                //
                $tabDataSite[$j] = 'O;' . $tab->getClrArt()->getCod() . ';' . $tab->getClrArt()->getClrSitStk01Adx() . ';'  . $tab->getClrArt()->getClrAhrAdx()->getCod() . ';';
                $xGstEmpAdx = (int)$tab->getClrArt()->getXGstEmpAdx() + 1;
                $tabDataSite[$j] = $tabDataSite[$j]  .   $xGstEmpAdx . ';GX;GX;GX;'  .  $tab->getClrArt()->getModReaAdx() . ';' .  $tab->getClrArt()->getTypSugAdx() . ';' .  $tab->getClrArt()->getSeiReaAdx();
                $j++;
            }
            if ($tab->getClrArt()->getClrSitStk02Adx()) {
                $tabDataSite[$j] = 'O;' . $tab->getClrArt()->getCod() . ';' . $tab->getClrArt()->getClrSitStk02Adx() . ';'  . $tab->getClrArt()->getClrAhrAdx()->getCod() . ';';
                $xGstEmpAdx = (int)$tab->getClrArt()->getXGstEmpAdx() + 1;
                $tabDataSite[$j] = $tabDataSite[$j]  .   $xGstEmpAdx . ';GX;GX;GX;'  .  $tab->getClrArt()->getModReaAdx() . ';' .  $tab->getClrArt()->getTypSugAdx() . ';' .  $tab->getClrArt()->getSeiReaAdx();

                $j++;
            }
            // mise à jour de la fiche article
            $tarticle = $tarticleRepository->findOneBy(['id' => $tab->getClrArt()]);
            $tarticle->setUsrUpd($this->getUser());
            $tarticle->setDatUpd(new \DateTime('now'));
            $tarticle->setDatAdxIns(new \DateTime('now'));

            $em->persist($tarticle);
            $tab->setXTrf(true);
            $em->persist($tab);
        }
        $em->flush();
        // dd($tabData);
        $this->writeFile('\\\\X3TEST\\reprises\article\\', 'itm01', $tabData);
        $this->writeFile('\\\\X3TEST\\reprises\article\\', 'itf01', $tabDataSite);


        $this->addFlash("success", "Les fichiers d'extraction sont générés ");
        return $this->redirectToRoute('arttrfadx_gst');
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
    /**
     * 
     */
    private function fillTartfou($tarticle, $data): void
    {
        $this->tartfouForm->setUsrIns($this->getUser());
        $this->tartfouForm->setDatIns(new \DateTime('now'));
        $this->tartfouForm->setQteCnd(1);
        $this->tartfouForm->setDev('eur');
        $this->tartfouForm->setDatPrx(new \DateTime('now'));
        $this->tartfouForm->setPrxAch(0);
        $this->tartfouForm->setPrxPbl(0);
        $this->tartfouForm->setQteMin(1);
        $this->tartfouForm->setClrArt($tarticle);
        $this->tartfouForm->setXEnrTrfAdx(true);
    }
    private function fillData($tarticle, $data, $tartfou)
    {
        $data->setCod($tarticle->getCod());
        if ($tarticle->getRefCtr()) {
            $data->setRefCtr($tarticle->getRefCtr());
        }
        if ($tarticle->getCodArtAncAdx()) {
            $data->setCodArtAncAdx($tarticle->getCodArtAncAdx());
        }
        if ($tarticle->getClrMrqice()) {
            $data->setclrMrqIce($tarticle->getClrMrqice());
        }

        $data->setLibCrtFr($tarticle->getLibCrtFr());
        if ($tarticle->getCodEan()) {
            $data->setCodEan($tarticle->getCodEan());
        };
        if ($tarticle->getLib01Adx()) {
            $data->setLib01Adx($tarticle->getLib01Adx());
        }
        if ($tarticle->getLib02Adx()) {
            $data->setLib02Adx($tarticle->getLib02Adx());
        }

        $data->setLib03Adx($tarticle->getLib03Adx());
        $data->setCleRchAdx($tarticle->getCleRchAdx());
        $data->setNrmAdx($tarticle->getNrmAdx());

        if ($tarticle->getClrApcAdx()) {
            $data->setClrApcAdx($tarticle->getClrApcAdx());
        }
        if ($tarticle->getClrFamniv1Adx()) {
            $data->setTfamartadx01($tarticle->getClrFamniv1Adx());
        }
        if ($tarticle->getClrFamniv2Adx()) {
            $data->setTfamartadx02($tarticle->getClrFamniv2Adx());
        }
        if ($tarticle->getClrFamniv3Adx()) {
            $data->setTfamartadx03($tarticle->getClrFamniv3Adx());
        }
        if ($tarticle->getClrCodCtaAdx()) {
            $data->setTcodctaadx($tarticle->getClrCodCtaAdx());
        }
        if ($tarticle->getClrNivTaxAdx()) {
            $data->setTtaxAdx($tarticle->getClrNivTaxAdx());
        }
        if ($tarticle->getModGstAdx()) {
            $data->setModGstAdx($tarticle->getModGstAdx());
        }
        if ($tarticle->getClrSitStk01Adx()) {
            $data->setTsitStk01Adx($tarticle->getClrSitStk01Adx());
        }
        if ($tarticle->getClrSitStk02Adx()) {
            $data->setTsitStk02Adx($tarticle->getClrSitStk02Adx());
        }
        if ($tarticle->getClrSitPrpAdx()) {
            $data->setTsitPrpAdx($tarticle->getClrSitPrpAdx());
        }
        if ($tarticle->getPds()) {
            $data->setPds($tarticle->getPds());
        }
        if ($tarticle->getPdsUnt()) {
            $data->setPdsUnt($tarticle->getPdsUnt());
        }
        if ($tarticle->getPrxBasAdx()) {
            $data->setPrxBasAdx($tarticle->getPrxBasAdx());
        }
        if ($tarticle->getMrgMinAdx()) {
            $data->setMrgMinAdx($tarticle->getMrgMinAdx());
        }
        if ($tarticle->getCtgAdx()) {
            $data->setCtgAdx($tarticle->getCtgAdx());
        }
        if ($tarticle->getClrAhrAdx()) {
            $data->setClrAhrAdx($tarticle->getClrAhrAdx());
        }
        if ($tarticle->getXGstEmpAdx() != null) {
            $data->setXGstEmpAdx($tarticle->getXGstEmpAdx());
        }
        $data->setModReaAdx($tarticle->getModReaAdx());
        $data->setTypSugAdx($tarticle->getTypSugAdx());
        $data->setSeiReaAdx($tarticle->getSeiReaAdx());
        // dd($tartfou);
        foreach ($tartfou as $tab) {

            if (!$data->getTfou01()) {

                $data->setTfou01($tab->getClrFou());
                if ($tab->getCodEan()) {
                    $data->setCodEan01($tab->getCodEan());
                }
                if ($tab->getPrt()) {
                    // dd('test2');
                    $data->setPrtFou01($tab->getPrt());
                }
                $data->setCodArt01($tab->getCodArt());
                $data->setXCntmrq01($tab->getXCntmrq());
            } elseif (!$data->gettfou02()) {
                //dd('test2');
                $data->settfou02($tab->getClrFou());
                if ($tab->getCodEan()) {
                    $data->setCodEan02($tab->getCodEan());
                }
                if ($tab->getPrt()) {
                    $data->setPrtFou02($tab->getPrt());
                }
                $data->setCodArt02($tab->getCodArt());
                $data->setXCntmrq02($tab->getXCntmrq());
            } elseif (!$data->gettfou03()) {
                $data->settfou03($tab->getClrFou());
                if ($tab->getCodEan()) {
                    $data->setCodEan03($tab->getCodEan());
                }
                if ($tab->getPrt()) {
                    $data->setPrtFou03($tab->getPrt());
                }
                $data->setCodArt03($tab->getCodArt());
                $data->setXCntmrq03($tab->getXCntmrq());
            } elseif (!$data->gettfou04()) {
                $data->settfou04($tab->getClrFou());
                if ($tab->getCodEan()) {
                    $data->setCodEan04($tab->getCodEan());
                }
                if ($tab->getPrt()) {
                    $data->setPrtFou04($tab->getPrt());
                }
                $data->setCodArt04($tab->getCodArt());
                $data->setXCntmrq04($tab->getXCntmrq());
            }
        }
    }
    private function fillSaveForm($tarticle, $data, $tartfou, $em)
    {


        $tarticle->setCod($data->getCod());

        if ($data->getRefCtr()) {
            $tarticle->setRefCtr($data->getRefCtr());
        }
        if ($data->getCodArtAncAdx()) {
            $tarticle->setCodArtAncAdx($data->getCodArtAncAdx());
        }
        if ($data->getclrMrqice()) {
            $tarticle->setClrMrqIce($data->getClrMrqice());
        }

        $tarticle->setLibCrtFr($data->getLibCrtFr());
        $tarticle->setPds($data->getPds());
        $tarticle->setPdsUnt($data->getPdsUnt());
        if ($data->getCodEan()) {
            $tarticle->setCodEan($data->getCodEan());
        }
        if ($data->getLib01Adx()) {
            $tarticle->setLib01Adx($data->getLib01Adx());
        }
        if ($data->getLib02Adx()) {
            $tarticle->setLib02Adx($data->getLib02Adx());
        }
        $tarticle->setLib03Adx($data->getLib03Adx());
        $tarticle->setCleRchAdx($data->getCleRchAdx());
        $tarticle->setNrmAdx($data->getNrmAdx());

        if ($data->getClrApcadx()) {
            $tarticle->setClrApcAdx($data->getClrApcadx());
        }
        if ($data->getTfamartadx01()) {
            $tarticle->setClrFamniv1Adx($data->getTfamartadx01());
        }
        // if ($data->getTfamartadx02()) {
        $tarticle->setClrFamniv2Adx($data->getTfamartadx02());
        // }
        // if ($data->getTfamartadx03()) {
        $tarticle->setClrFamniv3Adx($data->getTfamartadx03());
        // }
        // if ($data->getTCodCtaAdx()) {
        $tarticle->setClrCodCtaAdx($data->getTCodCtaAdx());
        // }
        // if ($data->getTtaxadx()) {
        $tarticle->setClrNivTaxAdx($data->getTtaxadx());
        // }
        // if ($data->getModGstAdx()) {
        $tarticle->setModGstAdx($data->getModGstAdx());
        // }
        // if ($data->getTsitStk01Adx()) {
        $tarticle->setClrSitStk01Adx($data->getTsitStk01Adx());
        // }
        // if ($data->getTsitStk02Adx()) {
        $tarticle->setClrSitStk02Adx($data->getTsitStk02Adx());
        // }
        // if ($data->getTsitPrpAdx()) {
        $tarticle->setClrSitPrpAdx($data->getTsitPrpAdx());
        // }
        // if ($data->getPrxBasAdx()) {
        $tarticle->setPrxBasAdx($data->getPrxBasAdx());
        // }
        // if ($data->getMrgMinAdx()) {
        $tarticle->setMrgMinAdx($data->getMrgMinAdx());
        // }
        // if ($data->getCtgAdx()) {
        $tarticle->setCtgAdx($data->getCtgAdx());
        // }
        // if ($data->getClrAhrAdx()) {
        $tarticle->setClrAhrAdx($data->getClrAhrAdx());
        // }
        $tarticle->setXGstEmpAdx($data->getXGstEmpAdx());
        $tarticle->setModReaAdx($data->getModReaAdx());
        $tarticle->setTypSugAdx($data->getTypSugAdx());
        $tarticle->setSeiReaAdx($data->getSeiReaAdx());
        // fournisseur
        // pour simplifier on supprime et on recrée les enregistrements -> pas optimisé

        foreach ($tartfou as $tab) {
            $em->remove($tab);
            //       $em->flush();
        }


        if ($data->getTfou01()) {
            $this->tartfouForm = new Tartfou();
            $this->fillTartfou($tarticle, $data);

            $this->tartfouForm->setClrFou($data->getTfou01());
            if ($data->getPrtFou01()) {
                $this->tartfouForm->setPrt($data->getPrtFou01());
            } else {
                $this->tartfouForm->setPrt(1);
            }
            if ($data->getCodEan01()) {
                $this->tartfouForm->setCodEan($data->getCodEan01());
            }
            $this->tartfouForm->setCodArt($data->getCodArt01());
            $this->tartfouForm->setXCntmrq($data->getXCntmrq01());
            $em->persist($this->tartfouForm);
        }
        if ($data->getTfou02() != null) {

            $this->tartfouForm = new Tartfou();
            $this->fillTartfou($tarticle, $data);

            $this->tartfouForm->setClrFou($data->getTfou02());
            if ($data->getPrtFou02()) {
                $this->tartfouForm->setPrt($data->getPrtFou02());
            } else {
                $this->tartfouForm->setPrt(1);
            }
            if ($data->getCodEan02()) {
                $this->tartfouForm->setCodEan($data->getCodEan02());
            }
            $this->tartfouForm->setCodArt($data->getCodArt02());
            $this->tartfouForm->setXCntmrq($data->getXCntmrq02());
            $em->persist($this->tartfouForm);
        }
        if ($data->getTfou03()) {
            $this->tartfouForm = new Tartfou();
            $this->fillTartfou($tarticle, $data);

            $this->tartfouForm->setClrFou($data->getTfou03());
            if ($data->getPrtFou03()) {
                $this->tartfouForm->setPrt($data->getPrtFou03());
            } else {
                $this->tartfouForm->setPrt(1);
            }
            if ($data->getCodEan03()) {
                $this->tartfouForm->setCodEan($data->getCodEan03());
            }
            $this->tartfouForm->setCodArt($data->getCodArt03());
            $this->tartfouForm->setXCntmrq($data->getXCntmrq03());
            $em->persist($this->tartfouForm);
        }
        if ($data->getTfou04()) {
            $this->tartfouForm = new Tartfou();
            $this->fillTartfou($tarticle, $data);

            $this->tartfouForm->setClrFou($data->getTfou04());
            if ($data->getPrtFou04()) {
                $this->tartfouForm->setPrt($data->getPrtFou04());
            } else {
                $this->tartfouForm->setPrt(1);
            }
            if ($data->getCodEan04()) {
                $this->tartfouForm->setCodEan($data->getCodEan04());
            }
            $this->tartfouForm->setCodArt($data->getCodArt04());
            $this->tartfouForm->setXCntmrq($data->getXCntmrq04());
            $em->persist($this->tartfouForm);
        }
    }
}
