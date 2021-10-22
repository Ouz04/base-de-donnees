<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\ArtType;
use App\Data\CtgiceData;
use App\Data\SearchData;
use App\Entity\Tarticle;
use App\Form\ArtRchType;
use App\Form\ArtTypeBis;
use App\Data\CtgiceData2;
use App\Form\FicheArtType;
use App\SpecClass\Reponse;
use App\Form\CtgiceFrmType;
use App\Form\SearchFormArt;
use App\Event\ProductViewEvent;
use App\Data\FichePersonnalisee;
use App\Entity\ArticleRecherche;
use App\Entity\ArticleRechercheb;
use App\Entity\ImageCol;
use App\Entity\Timage;
use App\Form\ImageColType;
use App\Repository\TartfouRepository;
use App\Repository\TarticleRepository;
use App\Repository\TcategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{

    /**
     * @Route("/mkt/article/creat", name="art_creat")
     */
    public function articleCreat(Request $request, EntityManagerInterface $em): Response
    {
        $tarticle = new Tarticle;
        $tarticle->setUsrIns($this->getUser());
        $tarticle->setDatIns(new \DateTime('now'));
        $form = $this->createForm(ArtType::class, $tarticle, [
            'attr' => [
                'readonly' => false,
                'disabled' => false
            ],
        ]);
        // $ctgiceData = new CtgiceData;
        // $formCtg = $this->createForm(CtgiceFrmType::class, $ctgiceData, [
        //     'attr' => [
        //         'readonly' => false,
        //         'disabled' => false
        //     ],
        // ]);
        $form->handleRequest($request);
        // $formCtg->handleRequest($request);
        if ($form->issubmitted() && $form->isValid()) {
            $images = $form->get('images')->getData();
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                
                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                
                // On crée l'image dans la base de données
                $img = new Timage;
                $img->setName($fichier);
                $tarticle->addTimage($img);
            }
            $tarticle = $form->getData();
           

            $em->persist($tarticle);
            $em->flush();
            return $this->redirectToRoute('art_gst');
        }
        return $this->render('article/artCM.html.twig', [
            'form' => $form->createView(),
            // 'formCtg' => $formCtg->createView(),
            'titre1' => 'Création ',
            'titre2' => 'article'

        ]);
    }
    /**
     * @Route("/mkt/article/edit/{id}", name="art_modif")
     * @Method({"POST"})
     */
    public function articleModif($id, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tarticle = $tarticleRepository->findOneBy(['id' => $id]);
        $tarticle->setUsrUpd($this->getUser());
        $tarticle->setDatUpd(new \DateTime('now'));
        $form = $this->createForm(ArtType::class, $tarticle, [
            'attr' => [
                'readonly' => true,
                'disabled' => false
            ],
        ]);

        $form->handleRequest($request);

        $tarticle = $form->getData();


        if (($form->isSubmitted() && $form->isValid())) {

            $images = $form->get('images')->getData();
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                
                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                
                // On crée l'image dans la base de données
                $img = new Timage;
                $img->setName($fichier);
                $tarticle->addTimage($img);
            }
            $tarticle = $form->getData();
            //dd($tarticle);

            $em->persist($tarticle);
            $em->flush();

            return $this->redirectToRoute('art_gst');
        }

        // return $this->render('article/artCM.html.twig', [
        return $this->render('article/artCM.html.twig', [
            'form' => $form->createView(),
            'tarticle' => $tarticle,
            'titre1' => 'Modification ',
            'titre2' => 'article'

        ]);
    }
    /**
     * @Route("/article/aff/{id}", name="art_aff")
     */
    public function articleAff($id, TarticleRepository $tarticleRepository, TartfouRepository $tartfouRepository,  Request $request, EntityManagerInterface $em, EventDispatcherInterface $dispatcher): Response
    {

        $tarticle = $tarticleRepository->findOneBy(['id' => $id]);
        //dd($tarticle->getTimages());
        $tartfou = $tartfouRepository->findBy(['clrArt' => $id]);
        $fiche= new FichePersonnalisee;
        $form = $this->createForm(FicheArtType::class, $fiche);
        $form->handleRequest($request);
        $pers="A";
        $pers=$tarticle->getId().'_'.$form->getData();
        
        
        $filename=glob( "./images/upload"."/".$tarticle->getCod()."*");
           // dd($filename,);

			
        return $this->render('article/artAff.html.twig', [
            'tarticle' => $tarticle,
            'form' => $form->createView(),
            //'form1' => $form1->createView(),
            'tartfou' => $tartfou,
            'tartImg'=> $filename,
            'pers'=>  $pers
        ]);
    }
    /**
     * @Route("/achmkt/article/gestion", name="art_gst")
     */
    public function articleListGst(TarticleRepository $articleRepository, Request $request): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchFormArt::class, $data, ['allow_extra_fields' => '01']);
        $form->handleRequest($request);

        $reponse = new Reponse;
        $maxResult = 2000;
        $tarticle = $articleRepository->findSearch($data, $maxResult, $reponse);
        //dd($tarticle);
        $nb = count($tarticle);
        include "shared/_flashFiltre.txt";
        // $nb = count($tarticle);
        // if ($nb == $maxResult) {
        //     $this->addFlash("warning", "Attention : tous les articles issus de la recherche ne sont pas affichés. C'est limité à " . $maxResult);
        // } elseif ($reponse->getVar01() == 'KO') {
        //     $this->addFlash("info", "Veuillez remplir le filtre pour la sélection d'article");
        // }
        ini_set('memory_limit', '-1');
        return $this->render('/article/artGst.html.twig', [
            'tarticle' => $tarticle,
            'form' => $form->createView(),
            'allow_extra_fields' => '01'
        ]);
    }
    /**
     * @Route("/achmkt/article/fiche/{pers}", name="art_fch_dwl")
     */
    public function articleFchPdfAff($pers, TartfouRepository $tartfouRepository, TarticleRepository $articleRepository, Request $request): Response
    {
        // recuperation article
        $data= explode('_', $pers);
       
        $id=$data[0];
        dump($id);
        $chks=$data[1];
        dump($chks);
        $chk1=substr($chks,0,1);
        $chk2=substr($chks,1,1);
       
        $chk3=substr($chks,2,1);
        $chk4=substr($chks,3,1);
        $chk5=substr($chks,4,1);
        $chk6=substr($chks,5,1);
        dump($chk1);
        dump($chk2);
        dump($chk3);
        dump($chk4);
        dump($chk5);
        dump($chk6);
        
       
            
        $tarticle = $articleRepository->findOneBy(['id' => $id]);
        $tartfou = $tartfouRepository->findBy(['clrArt' => $id]);
       
        
        // definition options pdf
        $pdfOptions = new Options();
        // police par défaut
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);
        //on instancie Dompdf
        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => True,
            ]
        ]);
        $dompdf->setHTTPCOntext($context);
        // on genere html
        $html = $this->renderView('article/fchPdf.html.twig', [
            'tarticle' => $tarticle,
            'tartfou'=>$tartfou,
            'chk1'=>$chk1,
            'chk2'=>$chk2,
            'chk3'=>$chk3,
            'chk4'=>$chk4,
            'chk5'=>$chk5,
            'chk6'=>$chk6,
            
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // on génère un nom de fihcier
        $fic = 'fiche_article_' . $this->getuser()->getId() . '.pdf';
        // on envoie le pdf au navigateur
        $dompdf->stream($fic, [
            'Attachement' => true
        ]);
        return new Response();
    }
    /**
     * @Route("/achmkt/article/download", name="art_dwl_csv")
     */
    public function articleDownloadCsv(TarticleRepository $articleRepository, Request $request): Response
    {
        $sessionuser = $this->session->get('user');
        // $user = $this->finduser($sessionuser);
        //search all the datas of type Object
        $datas = $articleRepository->findBy(['id' => 1]);
        // normalization and encoding of $datas
        $encoders = [new CsvEncoder()];
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $csvContent = $serializer->serialize($datas, 'csv');

        $response = new Response($csvContent);
        $response->headers->set('Content-Encoding', 'UTF-8');
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename=sample.csv');
        return $response;
    }
    /**
     * @Route("/achmkt/article/fichePer/{id}", name="art_fch_pers")
     */
    public function articleFchPersPdf($id, TarticleRepository $articleRepository,TartfouRepository $tartfouRepository, Request $request): Response
    {
        $tarticle = $articleRepository->findOneBy(['id' => $id]);
        $tartfou = $tartfouRepository->findBy(['clrArt' => $id]);
        $fiche= new FichePersonnalisee;
        $form = $this->createForm(FicheArtType::class, $fiche);
        $form->handleRequest($request);
        return $this->render('/article/artPer.html.twig', [
             'tarticle' => $tarticle,
             'tartfou'=>$tartfou,
            'form' => $form->createView(),
            
        ]);

    }
}

