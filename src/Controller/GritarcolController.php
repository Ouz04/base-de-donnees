<?php

namespace App\Controller;

use DateTime;


use App\Data\AppMrg;
use App\Entity\Tartfou;
use App\Form\TxMrgType;

use App\Data\SearchData;

use App\Entity\Tgritarcol;
use App\Entity\Tgritarett;
use App\SpecClass\Reponse;
use App\Data\ArtfouPrxData;
use App\Form\GtapstColType;
use App\Form\SearchFormArt;
use App\Data\TgritarpstFrmObsolete;
use App\Repository\TartcotRepository;
use App\Repository\TartfouRepository;
use App\Repository\TgritarettRepository;
use App\Repository\TgritarpstRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;

class GritarcolController extends AbstractController
{
    private $tartfou;
    public function __construct(EntityManagerInterface $em)
    {

        $this->em = $em;
    }
    // private $this->tartfou;
    /**
     * @Route("/cml/gritarcol/{idGta}", name="gritarcol_aff")
     */
    public function gtagstAff($idGta, SessionInterface $session, Request $request, TgritarpstRepository $tgritarpstRepository, TgritarettRepository $tgritarettRepository, TartfouRepository $tartfouRepository)
    {
    }

    /**
     * @Route("/cml/gritarcol/gestion/{idGta}", name="gritarcol_gst")
     */
    public function gtagstColGst(
        $idGta,
        SessionInterface $session,
        Request $request,
        TgritarpstRepository $tgritarpstRepository,
        TgritarettRepository $tgritarettRepository,
        TartcotRepository $tartcotRepository,
        TartfouRepository $tartfouRepository,
        EntityManagerInterface $em,
        PaginatorInterface $paginator
    ) {

        if ($idGta === '0') {

            $idGta = $request->getSession()->get('vsIdGta', '0');
        }
        if ($idGta === '0') {
            // throw new HttpException(400, "La grille tarifaire n'est pas sélectionnée");
            $this->addFlash("warning", "Veuillez sélectionner une grille tarifaire");
            return $this->redirectToRoute("cli_gst_gta");
        }
        $request->getSession()->set('vsIdGta', $idGta);

        // dump($request->getSession()->get('vsIdGta'));
        $page = (int)$request->query->getInt('page', 1);
        $limit = 5;
        //
        // $appMrg = new AppMrg;
        // $formTxMrg = $this->createForm(TxMrgType::class, $appMrg);
        // $formTxMrg->handleRequest($request);
        $searchData = new SearchData;
        $formSearch = $this->createForm(SearchFormArt::class, $searchData, ['allow_extra_fields' => '05']);
        $formSearch->handleRequest($request);
        // dump($formSearch->getData());

     

        $this->tartfou = $tartfouRepository->findSearchGta($searchData, $idGta);
        // dd($this->tartfou);
        $tgritarett = $tgritarettRepository->findOneBy(['id' => $idGta]);
        // dump($this->tartfou);
        $this->filtreTartfou($tgritarett);
        //$tgritarpst = $tgritarpstRepository->findBy(['clrGta' => $idGta], ['clrArt' => 'Asc']);
        $result = ($page * $limit) - $limit;

        $liste = $tgritarpstRepository->getPaginatedTgritarpst($idGta, $searchData, $page, $limit);
        $tgritarpst=$paginator->paginate(
            $liste,
            $page,
           $limit
        );
        $this->getLienGritarpstArtfou($tgritarpst, $em);

        $total = $tgritarpstRepository->getCountRqt($idGta);
        $totalSearch = $tgritarpstRepository->getCountRqt2($idGta, $searchData);
        $tgritarcol = new TgritarCol();

        foreach ($tgritarpst as $tab) {
            $tgritarcol->getTgritarpsts()->add($tab);
        }
         

        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            /** @var ClickableInterface $button  */
            $button = $formSearch->get("mrgExe");
            $marge = $formSearch->get('txMrg')->getData();
            if ($button->isClicked() && $marge > 0){
                

                foreach ($tgritarpst as $gta) {
                    if ($gta->getClrArtfou()) {
                        $total = $gta->getClrArtfou()->getPrxAch() + ($gta->getClrArtfou()->getPrxAch() * $marge) / 100;
                     //   dump($gta->getClrArtfou()->getPrxAch());
                        $gta->setPrxVte($total);
                        // dump($gta->setPrxVte($total));
                        // dump($total);
                    }
    
                    $em->persist($gta);
                }
                $em->flush();
            }           

        }   // ...
        
        

        $form = $this->createForm(GtapstColType::class, $tgritarcol);

        $form->handleRequest($request);
        $marge = 0;
        // if ($formTxMrg->isSubmitted() && $formTxMrg->isValid()) {
        //     $marge = $formTxMrg->get('txMrg')->getData();

        //     foreach ($tgritarpst as $gta) {
        //         if ($gta->getClrArtfou()) {
        //             $total = $gta->getClrArtfou()->getPrxAch() + ($gta->getClrArtfou()->getPrxAch() * $marge) / 100;
        //          //   dump($gta->getClrArtfou()->getPrxAch());
        //             $gta->setPrxVte($total);
        //             // dump($gta->setPrxVte($total));
        //             // dump($total);
        //         }

        //         $em->persist($gta);
        //     }
        //     $em->flush();
        // }

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($tgritarpst as $tag) {
                if ($tgritarcol->getTgritarpsts()->contains($tag) === false) {
                    $em->remove($tag);
                }
            }
            $em->flush();
            // redirect back to some edit page

            return $this->redirectToRoute('gritarcol_gst', ['idGta' => $idGta]);
        }
        ini_set('memory_limit', '-1');
        return $this->render('/gritarcol/gtapstCol.html.twig', [
            'form' => $form->createView(),
            'formSearch' => $formSearch->createView(),
            // 'formTxMrg' => $formTxMrg->createView(),
            'allow_extra_fields' => '05',
            'tgritarett' => $tgritarett,
            'tgritarpsts' => $tgritarpst,
            'total' => $total,
            'totalSearch' => $totalSearch,
            'limit' => $limit,
            'page' => $page,
            'tartfou' => $this->tartfou,
            'marge' => $marge,


        ]);
    }
    /**
     * @Route("/cml/gritarcol/supp/{id}", name="gritarcol_supp")
     */
    public function gritarpstSupp($id, TgritarpstRepository $tgritarpstRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tgritarpst = $tgritarpstRepository->findOneBy(['id' => $id]);

        $em->remove($tgritarpst);
        $em->flush();
        $this->addFlash("success", "Enregistrement supprimé");

        $idGta = $request->getSession()->get('vsIdGta', '0');

        return $this->redirectToRoute("gritarcol_gst", ['idGta' => $idGta]);
    }



    private function filtreTartfou(Tgritarett $tgritarett)
    {
        $tcotationRepository = $this->em->getRepository("App:Tcotation");
        $tcotcliRepository = $this->em->getRepository("App:Tcotcli");
        $tcotfamcliRepository = $this->em->getRepository("App:Tcotfamcli");
        $tclientRepository = $this->em->getRepository("App:Tcotfamcli");
        // dump($this->tartfou);
        $i = 0;
        $j = 0;
        $tid = array();
        foreach ($this->tartfou as $artfou) {
            $xDel = false;
            if ($artfou->getClrCot()) {
                $tartCot = $tcotationRepository->findOneBy(['id' => $artfou->getClrCot()->getId()]);
                $datStr1 = date_format(new \DateTime('now'), 'Y-m-d');
                $datDebCot = date_format($tartCot->getDatDeb(), 'Y-m-d');
                $datFinCot = date_format($tartCot->getDatFin(), 'Y-m-d');
                // dump(strtotime($datDebCot));
                // dump(strtotime($datStr1));
                // on verifie si cotation active à la date
                if (strtotime($datDebCot) <= strtotime($datStr1) && strtotime($datFinCot) >= strtotime($datStr1)) {
                    $id = $artfou->getId();
                    // on verifie si client concerné

                    $tcotcli = $tcotcliRepository->findOneBy(['clrCot' => $artfou->getClrCot()->getId(), 'clrCli' => $tgritarett->getClrCli()->getId()]);

                    if (!$tcotcli) {

                        // recherche sur famille client
                        if ($tgritarett->getClrCli()->getClrFamcli()) {

                            $tcotfamcli = $tcotfamcliRepository->findOneBy(['clrCot' => $artfou->getClrCot()->getId(), 'clrFamcli' => $tgritarett->getClrCli()->getClrFamcli()->getId()]);
                            // dump($tcotfamcli);
                            if (!$tcotfamcli) {
                                $tid[$i] = $j;
                                $i++;
                                $xDel = true;
                            }
                        } else { // pas de famille client dans Tclient
                            // dd('pas de famille cli tgritarett');
                            $tid[$i] = $j;
                            $i++;
                            $xDel = true;
                            dump('suppression cotation sur ' . $artfou->getClrArt()->getcod());
                        }
                    }
                } else { // cotation non active dans la période
                    $tid[$i] = $j;
                    $i++;
                    $xDel = true;
                }
            }
            $j++;
        }
        foreach ($tid as $id) {
            // dump('id' . $id);
            $colors = array_column($this->tartfou, 'id');
            unset($this->tartfou[$id]);
        }
        // dump($this->tartfou);
        // dd($this->tartfou);
    }
    /**
     * est appelé quand on clique sur le bouton pour sélectionner l'enregistrement artfou
     *@Route("/cml/gritarcol/artfou/chkbox/sel/{id}",name="gta_artfou_sel")
     *
     * @param Tarticle $tarticle
     * @param EntityManagerInterface $em
     * @param TgritarpstRepository $tgritarpstRepository
     * @return Response
     */
    public function gtaArtfouSel($id, TartfouRepository $tartfouRepository, TgritarettRepository $tgritarettRepository, TgritarpstRepository $tgritarpstRepository, Request $request,  EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->json(
                [
                    'code' => 403,
                    'message' => 'Non autorisé'
                ],
                403
            );
        }
        // dd($request);
        $idGta = $request->getSession()->get('vsIdGta', '0');
        if ($id) {
            $tartfou = $tartfouRepository->findOneBy(['id' => $id]);

            if ($tartfou) {
                $tgritarpst = $tgritarpstRepository->findOneBy(['clrGta' => $idGta, 'clrArt' => $tartfou->getClrArt()]);
                if ($tgritarpst) {
                    $tgritarpst->setClrArtfou($tartfou);
                    $em->persist($tgritarpst);
                    $em->flush();
                    return $this->json(
                        [
                            'code' => 200,
                            'message' => 'Mise à jour effectuée'
                        ],
                        200
                    );
                }
            }

            if ($idGta) {

                // on verifie si article pas déjà présent dans grille tarifaire

                if (!$tartfou) {
                    return $this->json(
                        [
                            'code' => 403,
                            'message' => 'Article-fournisseur non trouvé'
                        ],
                        402
                    );
                }
                // $em->persist($tgritarpst);
                // $em->flush();
            }
        }


        if (!$idGta) {
            return $this->json(
                [
                    'code' => 403,
                    'message' => 'Pas de grille tarifaire sélectionnée'
                ],
                403
            );
        }
    }
    /**
     * est appelé quand on clique sur le bouton pour désélectionner l'enregistrement artfou
     *@Route("/cml/gritarcol/artfou/chkbox/dsel/{id}",name="gta_artfou_dsel")
     *
     * @param Tarticle $tarticle
     * @param EntityManagerInterface $em
     * @param TgritarpstRepository $tgritarpstRepository
     * @return Response
     */
    public function gtaArtfouDSel($id, TartfouRepository $tartfouRepository, TgritarpstRepository $tgritarpstRepository, Request $request,  EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->json(
                [
                    'code' => 403,
                    'message' => 'Non autorisé'
                ],
                403
            );
        }
        // dd($request);
        $idGta = $request->getSession()->get('vsIdGta', '0');

        if ($id) {
            $tartfou = $tartfouRepository->findOneBy(['id' => $id]);

            if ($tartfou) {
                $tgritarpst = $tgritarpstRepository->findOneBy(['clrGta' => $idGta, 'clrArt' => $tartfou->getClrArt()]);
                if ($tgritarpst) {

                    return $this->json(
                        [
                            'code' => 200,
                            'message' => 'Suppression effectuée'
                        ],
                        200
                    );
                } else {
                    return $this->json(
                        [
                            'code' => 403,
                            'message' => "suppression déjà présente"
                        ],
                        200
                    );
                }
            }
        }

        if (!$idGta) {
            return $this->json(
                [
                    'code' => 403,
                    'message' => 'Pas de grille tarifaire sélectionnée'
                ],
                403
            );
        }
    }
    /**
     * alimente tgritarpst.clrArtfou s'il est nul
     */
    private function getLienGritarpstArtfou($tgritarpst, EntityManagerInterface $em): void
    {
   
        $xtrv = false;
        $xSave = false;

        foreach ($tgritarpst as $gritarpst) {
            // on recherche lien clrArtfou si vide
            $lclTartfou = [];
            $i = 0;
            if (!$gritarpst->getclrArtfou()) {
                // dump('coucou');
                foreach ($this->tartfou as $artfou) {

                    if ($artfou->getClrArt() == $gritarpst->getClrArt()) {

                        $lclTartfou[$i] = $artfou;

                        $i++;
                    }
                }
                // on privilégie la cotation
                $xtrv = false;

                foreach ($lclTartfou as $artfou) {
                    if ($artfou->getClrCot()) {

                        $gritarpst->setClrArtfou($artfou);
                        $gritarpst->setPrxTxe($artfou->getPrxTxe());
                        $gritarpst->setPrxTxs($artfou->getPrxTxs());
                        $em->persist($gritarpst);
                        $xtrv = true;
                        $xSave = true;
                        
                    }
                }
                if ($xtrv == false) { // on prend le premier
                    foreach ($lclTartfou as $artfou) {
                        $gritarpst->setClrArtfou($artfou);
                        $gritarpst->setPrxTxe($artfou->getPrxTxe());
                        $gritarpst->setPrxTxs($artfou->getPrxTxs());                        
                        $em->persist($gritarpst);
                        $xtrv = true;
                        $xSave = true;
                        break;
                    }
                }
            }
        }
        if ($xSave) {
            $em->flush();
        }
        // dump($tgritarpst);
    }
}
