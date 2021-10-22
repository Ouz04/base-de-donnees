<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Tuser;
use App\Form\LoginType;
use App\Form\ResetPassType;
use App\Event\UsrInitPwdEvent;
use App\Repository\UserRepository;
use App\Repository\TuserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $form = $this->createForm(LoginType::class, ['email' => $utils->getLastUsername()]);
        // $form = $factory->createNamed('', LoginType::class, ['_username' => $utils->getLastUsername()]);


        return $this->render('security/login.html.twig', [
            'formView' => $form->createView(),
            'error' => $utils->getLastAuthenticationError()
        ]);
    }
    /**
     * @Route("/logout",name="security_logout")
     */
    public function logout()
    {
        dd('sortie');
        //   echo "test";
    }
    /**
     * @Route("/app_forgotten_password", name="app_forgotten_password")
     */
    public function oubliPass(Request $request, TuserRepository $tuserRepository, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator, UserPasswordEncoderInterface $encoder, EventDispatcherInterface $dispatcher): Response
    {

        // On initialise le formulaire
        $form = $this->createForm(ResetPassType::class);

        // On traite le formulaire
        $form->handleRequest($request);

        // Si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les données
            $donnees = $form->getData();

            // On cherche un utilisateur ayant cet e-mail
            $tuser = $tuserRepository->findOneByEmail($donnees['email']);

            // Si l'utilisateur n'existe pas
            if ($tuser === null) {
                // On envoie une alerte disant que l'adresse e-mail est inconnue
                $this->addFlash('danger', 'Cette adresse e-mail est inconnue');

                // On retourne sur la page de connexion
                return $this->redirectToRoute('security_login');
            }

            // On génère un token

            $token = $tokenGenerator->generateToken();

            // On essaie d'écrire le token en base de données
            try {
                $tuser->setResetToken($token);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tuser);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('security_login');
            }

            // On génère l'URL de réinitialisation de mot de passe
            $url = $this->generateUrl('app_reset_password', array('token' =>  $token), UrlGeneratorInterface::ABSOLUTE_URL);

            // On génère l'e-mail
            $usrInitPwdEvent = new UsrInitPwdEvent($tuser, $url);
            $dispatcher->dispatch($usrInitPwdEvent, 'usrInitPwd.success');

            // $message = (new \Swift_Message('Mot de passe oublié'))
            // ->setFrom('ousmanemoussathiam@gmail.com')
            // ->setTo($tuser->getEmail())
            //     ->setBody(
            //         "Bonjour,<br><br>Une demande de réinitialisation de mot de passe a été effectuée pour le site Dyadem. Veuillez cliquer sur le lien suivant : " . $url,
            //         'text/html'
            //     );

            // // On envoie l'e-mail
            // $mailer->send($message);

            // On crée le message flash de confirmation

            $this->addFlash('success', 'E-mail de réinitialisation du mot de passe envoyé !');
            // On redirige vers la page de login
            return $this->redirectToRoute('security_login');
        }

        // On envoie le formulaire à la vue
        return $this->render('security/forgotten_password.html.twig', ['emailForm' => $form->createView()]);
    }
    /**
     * @Route("/app_reset_password/{token}", name="app_reset_password")
     *
     * 
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {
        // on cherche un utilisateur avec le token donné
        $tuser = $this->getDoctrine()->getRepository(Tuser::class)->findOneBy(['resetToken' => $token]);
        // Si l'utilisateur n'existe pas
        if ($tuser === null) {
            // On affiche une erreur
            $this->addFlash('danger', 'Token Inconnu');
            return $this->redirectToRoute('security_login');
        }

        // Si le formulaire est envoyé en méthode post
        if ($request->isMethod('POST')) {
            // On supprime le token
            $tuser->setResetToken(null);

            // On chiffre le mot de passe
            $tuser->setPassword($passwordEncoder->encodePassword($tuser, $request->request->get('password')));

            // On stocke
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tuser);
            $entityManager->flush();

            // On crée le message flash
            $this->addFlash('message', 'Mot de passe mis à jour');

            // On redirige vers la page de connexion
            return $this->redirectToRoute('security_login');
        } else {
            // Si on n'a pas reçu les données, on affiche le formulaire
            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }
    }
  
}
