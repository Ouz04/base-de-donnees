<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Tarticle;
use App\Entity\Tcategorie;
use App\Entity\Tgritarpst;
use App\Form\CategoryType;
use App\SpecClass\Reponse;
use App\Form\SearchFormArt;
use App\Form\SearchFormCopy;
use App\Repository\TarticleRepository;
use App\Repository\TcategorieRepository;
use App\Repository\TgritarettRepository;
use App\Repository\TgritarpstRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\Length;

class CatalogueController extends AbstractController
{
    protected $tcategorieRepository;
    public function __construct(TcategorieRepository $tcategorieRepository)
    {
        //   $this->tcategorieRepository = $tcategorieRepository;
    }

    /**
     * @Route("/ctlg/ctg/art/{id}/aff", name="ctl_ctg_art_aff")
     */
    public function articleAff($id, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tarticle = $tarticleRepository->findOneBy(['id' => $id]);

        return $this->render('catalogue/ctlArtAff.html.twig', [
            'tarticle' => $tarticle
        ]);
    }
    /**
     * @Route("/ctlg/lstart", name="ctl_lstart")
     */
    public function ctlLstArt(TarticleRepository $articleRepository, Request $request, TgritarpstRepository $tgritarpstRepository, TgritarettRepository $tgritarettRepository): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormArt::class, $data, ['allow_extra_fields' => '04']);
        $form->handleRequest($request);

        $reponse = new Reponse;
        $maxResult = 2000;
        $idGta = $request->getSession()->get('vsIdGta', '0');
        $tarticle = $articleRepository->findSearch($data, $maxResult, $reponse, $idGta);
        // dump($tarticle);
        $nb = count($tarticle);
        include "shared/_flashFiltre.txt";


        $tgritarett = [];

        if ($idGta <> '0') {
            $tgritarett = $tgritarettRepository->findOneBy(['id' => $idGta]);
            //      $tgritarpst = $tgritarpstRepository->findBy(['clrGta' => $idGta], ['clrArt' => 'desc']);

        }
        // on ajoute une information dans le champ ChpTrv pour qu'on sache qu'il est dans la grille tarifaire 
        $i = 0;
        $artId = "_";
        foreach ($tarticle as $value) {
            $pst = $tgritarpstRepository->findBy(['clrGta' => $idGta, 'clrArt' => $value->getId()]);
            if ($pst) {
                $value->setChpTrv('OK');
            } else {
                $value->setChpTrv('KO');
            }

            $artId = $artId . "_" . $value->getId();
            $i++;
        }

        
        return $this->render('/catalogue/ctlLstArt.html.twig', [
            'tarticle' => $tarticle,
            //  'tgritarpst' => $tgritarpst,
            'tgritarett' => $tgritarett,
            'form' => $form->createView(),
            'allow_extra_fields' => '04',
            'artId' => $artId
        ]);
    }
    /**
     * @Route("/ctlg/art/maj/{id}",name="gta_art_maj")
     */
    public function ctlArtGtaMaj($id, TarticleRepository $tarticleRepository, TgritarettRepository $tgritarettRepository, Request $request, TgritarpstRepository $tgritarpstRepository, EntityManagerInterface $em)
    {
        // dd($request);
        $xAjt=false;
        $xSup=false;
        $idGta = $request->getSession()->get('vsIdGta', '0');
        
        
        if ($idGta) {

            // on verifie si article pas déjà présent dans grille tarifaire
            $tgritarpst = $tgritarpstRepository->findOneBy(['clrGta' => $idGta, 'clrArt' => $id]);

            if (!$tgritarpst) {
                $tgritarpst = new Tgritarpst;
                $tgritarpst->setUsrIns($this->getUser());
                $tgritarpst->setDatIns(new \DateTime('now'));
                $tgritarpst->setClrGta($tgritarettRepository->findOneBy(['id' => $idGta]));
                $tarticle = $tarticleRepository->findOneBy(['id' => $id]);
                $tgritarpst->setClrArt($tarticle);
    
                $tgritarpst->setLibArt($tarticle->getLibCrtFr());
                $tgritarpst->setCodArt($tarticle->getCod());
                $tgritarpst->setPrxAch(20);
                $tgritarpst->setPrxTxe(0);
                $tgritarpst->setPrxTxS(0);
                $tgritarpst->setPrxVte(0);
                $tgritarpst->setTxMrg(0);
                $tgritarpst->setXbpu(0);
                $tgritarpst->setXDvs(0);
                $em->persist($tgritarpst);
                $em->flush();
                $xAjt=true;
            } else {
                $em->remove($tgritarpst);
                $em->flush();
                $xSup=true;
            }
            $msg='Aucune modification';
            if ($xAjt){
                $msg='Ajout article GTA ' . $id;
            }elseif ($xSup){
                $msg='Suppression article GTA ' . $id;
            }
            return $this->json(
                [
                    'code' => 200,
                    'message' => $msg
                ],
                200
            );
        }

    }
   
    /**
     * Undocumented function
     *@Route("/article/gta/ajt_mlt/{artId}",name="gta_art_ajt_mlt")
     *
     * @param Tarticle $tarticle
     * @param EntityManagerInterface $em
     * @param TgritarpstRepository $tgritarpstRepository
     * @return Response
     */
    public function gtaArtAjtMultiple($artId, TarticleRepository $tarticleRepository, TgritarettRepository $tgritarettRepository, TgritarpstRepository $tgritarpstRepository, Request $request,  EntityManagerInterface $em): Response
    {
        $cpt=0;
        $xSave = false;

        // $data = $request->request->all();
   
        $data = explode('_', $artId);

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
        //  dd($request);
        $idGta = $request->getSession()->get('vsIdGta', '0');

        if ($idGta) {

            // on décompose $data
            for ($i = 1; $i < count($data); $i++){
            // foreach ($data as $id) {
                // foreach ($id as $value) {
                $id= $data[$i] ; 
                $value = (int)$id;
                // on verifie si article pas déjà présent dans grille tarifaire
                $tarticle = $tarticleRepository->findOneBy(['id' => $value]);
                if ($tarticle) {
                    $tgritarpst = $tgritarpstRepository->findOneBy(['clrGta' => $idGta, 'clrArt' => $tarticle]);
                    if (!$tgritarpst) {
                        $tgritarpst = new Tgritarpst;
                        $tgritarpst->setUsrIns($this->getUser());
                        $tgritarpst->setDatIns(new \DateTime('now'));
                        $tgritarpst->setClrGta($tgritarettRepository->findOneBy(['id' => $idGta]));
                        // $tarticle = $tarticleRepository->findOneBy(['id' => $id]);
                        $tgritarpst->setClrArt($tarticle);

                        $tgritarpst->setLibArt($tarticle->getLibCrtFr());
                        $tgritarpst->setCodArt($tarticle->getCod());
                        $tgritarpst->setPrxAch(20);
                        $tgritarpst->setPrxTxe(0);
                        $tgritarpst->setPrxTxS(0);
                        $tgritarpst->setPrxVte(0);
                        $tgritarpst->setTxMrg(0);
                        $tgritarpst->setXbpu(0);
                        $tgritarpst->setXDvs(0);
                        $em->persist($tgritarpst);
                        $xSave = true;
                        $cpt++;
                    }
                    // }
                }
            }

            if ($xSave) {
                $em->flush();
                return $this->json(
                    [
                        'code' => 200,
                        'message' => 'Ajout ' . $cpt . ' article'
                    ],
                    200
                );
            } else {
                return $this->json(
                    [
                        'code' => 200,
                        'message' => 'Aucune donnée mise à jour'
                    ],
                    200
                );
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
        return $this->redirectToRoute('ctl_lstart');
    }
    /**
     * Undocumented function
     *@Route("/article/gta/sup_mlt/{artId}",name="gta_art_sup_mlt")
     *
     * @param Tarticle $tarticle
     * @param EntityManagerInterface $em
     * @param TgritarpstRepository $tgritarpstRepository
     * @return Response
     */
    public function gtaArtSupMultiple($artId,TarticleRepository $tarticleRepository, TgritarettRepository $tgritarettRepository, TgritarpstRepository $tgritarpstRepository, Request $request,  EntityManagerInterface $em): Response
    {
        $cpt=0;
        $xSave = false;
        $data = explode('_', $artId);

        //   return new JsonResponse([
        //       'success' => true,
        //       'data'    => $data // Your data here
        //   ]);


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
        //  dd($request);
        $idGta = $request->getSession()->get('vsIdGta', '0');

        if ($idGta) {

            // on décompose $data
            for ($i = 1; $i < count($data); $i++){

                $id= $data[$i] ;

                $value = (int)$id;
                $tarticle = $tarticleRepository->findOneBy(['id' => $value]);
                // on verifie si article pas déjà présent dans grille tarifaire
                if ($tarticle) {

                    $tgritarpst = $tgritarpstRepository->findOneBy(['clrGta' => $idGta, 'clrArt' => $tarticle]);
                    if ($tgritarpst) {
                        // return $this->json(
                        //     [
                        //         'code' => 403,
                        //         'message' => 'article trouve'
                        //     ],
                        //     403
                        // );
                        $em->remove($tgritarpst);

                        // $em->persist($tgritarpst);
                        $xSave = true;
                        $cpt++;
                    }
                }



                // }

            }

            if ($xSave) {
                $em->flush();
                return $this->json(
                    [
                        'code' => 200,
                        'message' => 'Suppression en masse ' . $cpt . ' article(s) GTA'
                    ],
                    200
                );
            } else {
                return $this->json(
                    [
                        'code' => 200,
                        'message' => 'Aucune donnée mise à jour'
                    ],
                    200
                );
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
        return $this->redirectToRoute('ctl_lstart');
    }
    //   /**
    //  * Undocumented function
    //  *@Route("/article/gta/sup_mlt/{artId}",name="gta_art_sup_mlt2")
    //  *
    //  * @param Tarticle $tarticle
    //  * @param EntityManagerInterface $em
    //  * @param TgritarpstRepository $tgritarpstRepository
    //  * @return Response
    //  */
    // public function gtaArtSupMultiple2($artId,TarticleRepository $tarticleRepository, TgritarettRepository $tgritarettRepository, TgritarpstRepository $tgritarpstRepository, Request $request,  EntityManagerInterface $em): Response
    // {
    //     $cpt=0;
    //     $xSave = false;
    //     $data = explode('_', $artId);

    //     //   return new JsonResponse([
    //     //       'success' => true,
    //     //       'data'    => $data // Your data here
    //     //   ]);


    //     $user = $this->getUser();

    //     //  dd($request);
    //     $idGta = $request->getSession()->get('vsIdGta', '0');

    //     if ($idGta) {

    //         // on décompose $data
    //         for ($i = 1; $i < count($data); $i++){

    //             $id= $data[$i] ;

    //             $value = (int)$id;
    //             $tarticle = $tarticleRepository->findOneBy(['id' => $value]);
    //             // on verifie si article pas déjà présent dans grille tarifaire
    //             if ($tarticle) {

    //                 $tgritarpst = $tgritarpstRepository->findOneBy(['clrGta' => $idGta, 'clrArt' => $tarticle]);
    //                 if ($tgritarpst) {
    //                     // return $this->json(
    //                     //     [
    //                     //         'code' => 403,
    //                     //         'message' => 'article trouve'
    //                     //     ],
    //                     //     403
    //                     // );
    //                     $em->remove($tgritarpst);

    //                     // $em->persist($tgritarpst);
    //                     $xSave = true;
    //                     $cpt++;
    //                 }
    //             }



    //             // }

    //         }

    //         if ($xSave) {
    //             $em->flush();
    //             return $this->json(
    //                 [
    //                     'code' => 200,
    //                     'message' => 'Suppression en masse ' . $cpt . ' article GTA'
    //                 ],
    //                 200
    //             );
    //         } else {
    //             return $this->json(
    //                 [
    //                     'code' => 200,
    //                     'message' => 'Aucune donnée mise à jour'
    //                 ],
    //                 200
    //             );
    //         }
    //     }

    //     if (!$idGta) {
    //         return $this->json(
    //             [
    //                 'code' => 403,
    //                 'message' => 'Pas de grille tarifaire sélectionnée'
    //             ],
    //             403
    //         );
    //     }

    // }
}
