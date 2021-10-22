<?php

namespace App\Controller;

use App\Entity\Tfamcli;
use App\Entity\Tsocgpe;
use App\Entity\Tsocgpt;
use App\Entity\Tsociete;
use App\Form\FamcliType;
use App\Form\SocgpeType;
use App\Form\SocgptType;
use App\Form\SocieteType;
use App\Repository\TclientRepository;
use App\Repository\TfamcliRepository;
use App\Repository\TsocgpeRepository;
use App\Repository\TsocgptRepository;
use App\Repository\TarticleRepository;
use App\Repository\TsocieteRepository;
use App\Repository\TbpartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SocgptController extends AbstractController
{
    /**
     * @Route("admin/socgpt/creat", name="socgpt_creat")
     */
    public function SocgptCreat(Request $request,TsocgptRepository $tsocgptRepository, EntityManagerInterface $em): Response
    {
        $tsoc = new Tsocgpt;
        $tsoc->setUsrIns($this->getUser());
        $tsoc->setDatIns(new \DateTime('now'));

        $form01 = $this->createForm(SocgptType::class,  $tsoc, [
            'attr' => [
                'readonly' => false,
                'disabled' => false
            ]
        ]);
        $form01->handleRequest($request);


        if ($form01->issubmitted() && $form01->isValid()) {
            //dd($form01);

            $tsoc = $form01->getData();          
            $nom=$form01->get('cod')->getData();
            $cod=$tsocgptRepository->findOneBy(['cod'=>$nom]);
         
            if ($cod) {
                $this->addFlash("warning", "Enregistrement existe déja");
            }else {
                $em->persist( $tsoc);
                $this->addFlash("success", "Enregistrement ajouté");
            }    
            $em->flush();    
           

            return $this->redirectToRoute('socgpt_gst');
        } else {

            $this->addFlash("error", "Zones Famcli non renseignées");
        }

        return $this->render('socgpt/socgptCM.html.twig', [
            'form' => $form01->createView(),
            'titre1' => 'Création ',
            'titre2' => 'Groupement Societe',
        ]);
    }
    /**
     * @Route("admin/socgpt/edit/{id}", name="socgpt_modif")
     */
    public function SocgptModif($id, TsocgptRepository $tsocgptRepository, TbpartnerRepository $tbpartnerRepository, Request $request, EntityManagerInterface $em): Response
    {

        $tsoc = $tsocgptRepository->findOneBy(['id' => $id]);

        $form01 = $this->createForm(SocgptType::class,   $tsoc, [
            'attr' => [
                'readonly' => true,
                'disabled' => false
            ],
        ]);

        $form01->handleRequest($request);
        if ($form01->isSubmitted() && $form01->isValid()) {
            // $product = $form->getData();

            $em->flush();

            return $this->redirectToRoute('socgpt_gst');
        }
        return $this->render('socgpt/socgptCM.html.twig', [
            'form' => $form01->createView(),
            'tfamcli' => $tsoc,
            'titre1' => 'Modification ',
            'titre2' => 'Groupement Societe'

        ]);
    }
    /**
     * @Route("admin/socgpt/supp/{id}", name="socgpt_supp")
     */
    public function SocgptSupp($id, TsocgptRepository $tsocgptRepository,TclientRepository $tclientRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tsoc = $tsocgptRepository->findOneBy(['id' => $id]);

        if (!$tsoc) {
            throw $this->createNotFoundException("Le groupe societe $id n'existe pas et ne peut pas être supprimée");
        }
        $tclient = $tclientRepository->findBy(['clrSoc' =>  $tsoc->getId()]);
        if ($tclient) {
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (client) ');
            //   throw $this->createNotFoundException("L'organisation $id ne peut pas être supprimée car il y a au moins une liaison (cotorg)");
        }
        $tarticle = $tarticleRepository->findBy(['clrApcAdx' =>  $tsoc->getId()]);
        if ($tarticle) {
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (article) ');
            //   throw $this->createNotFoundException("L'organisation $id ne peut pas être supprimée car il y a au moins une liaison (cotorg)");
        }
        
        else {
            $em->remove($tsoc);
            $em->flush();
            $this->addFlash("success", "Enregistrement supprimé");
        }

        return $this->redirectToRoute("socgpt_gst");
    }
    /**
     * @Route("admin/socgpt/gestion", name="socgpt_gst")
     */
    public function SocgptListShow(TsocgptRepository $tsocgptRepository,  Request $request): Response
    {

        $tsoc = $tsocgptRepository->findAll();

        return $this->render('socgpt/socgptGst.html.twig', [
            'tsoc' => $tsoc,

        ]);
    }
}
