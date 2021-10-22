<?php

namespace App\Controller;

use App\Entity\Tuser;
use App\Form\UsrType;
use App\Event\UsrCreatEvent;
use App\Repository\TuserRepository;
use App\Repository\TusrcmlRepository;
use App\Repository\TarticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/user/creat", name="usr_creat")
     */
    public function userCreat(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, EventDispatcherInterface $dispatcher): Response
    {
        $tuser = new Tuser;

        $tuser->setUsrIns($this->getUser());
        $tuser->setDatIns(new \DateTime('now'));
        $form = $this->createForm(UsrType::class, $tuser, ['attr' => ['readonly' => false],]);
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {

            $tuser = $form->getData();

            if ($form->get('plainPassword')->getData()) {

                $tuser->setPassword(
                    $encoder->encodePassword(
                        $tuser,
                        $form->get('plainPassword')->getData()
                    )
                );
            }
            $tuser->setPlainPassword('');
            $em->persist($tuser);
            $em->flush();
            // envoi mail
            $usrCreatEvent = new UsrCreatEvent($tuser, $form->get('plainPassword')->getData());
            $dispatcher->dispatch($usrCreatEvent, 'usrCreat.success');
            $this->addFlash("success", 'Un mail a été envoyé au nouvel utilisateur');
            return $this->redirectToRoute('usr_gst');
        } else {

        }
        return $this->render('user/usrCM.html.twig', [
            'formView' => $form->createView(),
            'titre1' => 'Création ',
            'titre2' => 'utilisateur'

        ]);
    }
    /**
     * @Route("/admin/user/edit/{id}", name="usr_modif")
     */
    public function userModif($id, TuserRepository $tuserRepository, Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, EventDispatcherInterface $dispatcher): Response
    {
       
        $tuser = $tuserRepository->findOneBy(['id' => $id]);
        $tuser->setUsrUpd($this->getUser());
        $tuser->setDatUpd(new \DateTime('now'));
        $form = $this->createForm(UsrType::class, $tuser, ['attr' => ['readonly' => true],]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // $product = $form->getData();
            if ($form->get('plainPassword')->getData()) {

                $tuser->setPassword(
                    $encoder->encodePassword(
                        $tuser,
                        $form->get('plainPassword')->getData()
                    )
                );
            }
            $tuser->setPlainPassword('');
        

            $em->flush();

            return $this->redirectToRoute('usr_gst');
        }
        return $this->render('user/usrCM.html.twig', [
            'formView' => $form->createView(),
            'tuser' => $tuser,
            'titre1' => 'Modification ',
            'titre2' => 'utilisateur'

        ]);
    }
    /**
     * @Route("/admin/user/supp/{id}", name="usr_supp")
     */
    public function userSupp($id, TuserRepository $tuserRepository, TusrcmlRepository $tusrcmlRepository, TarticleRepository $tarticleRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tuser = $tuserRepository->findOneBy(['id' => $id]);

        if (!$tuser) {
            throw $this->createNotFoundException("L'utilisateur' $id n'existe pas et ne peut pas être supprimé");
        }
        $tusrcml = $tusrcmlRepository->findBy(['clrUsr' => $tuser->getId()]);
        if ($tusrcml) {
            // throw $this->createNotFoundException("La cotation $id ne peut pas être supprimée car il y a au moins une liaison (cotorg)");
            $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (usrcml) ');
        } else {
            $tarticle = $tarticleRepository->findBy(['usrIns' => $tuser->getId()]);
            if ($tarticle) {
                $this->addFlash("warning", 'Suppression non effectuée : il existe au moins une liaison (article) ');
                //   throw $this->createNotFoundException("La cotation $id ne peut pas être supprimée car il y a au moins une liaison(artcot)");
            } else {
                $em->remove($tuser);
                $em->flush();
                $this->addFlash("success", "Enregistrement supprimé");
            }
        }

        return $this->redirectToRoute("usr_gst");
    }

    /**
     * @Route("/admin/user/gestion", name="usr_gst")
     */
    public function userListGst(TuserRepository $tuserRepository): Response
    {
        $tuser = $tuserRepository->findBy([], ['email' => 'ASC']);

        if (!$tuser) {
            throw $this->createNotFoundException("Erreur d'appel utilisateur X");
        }
        return $this->render('/user/usrGst.html.twig', [
            'tuser' => $tuser,

        ]);
    }
}
