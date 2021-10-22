<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\Security\Http\ParameterBagUtils;
use Symfony\Component\Security\Http\Firewall\LogoutListener;
use Symfony\Component\Security\Core\Exception\LogoutException;
use Symfony\Component\Security\Http\Firewall\AbstractListener;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CutomLogoutListener extends LogoutListener
{
    protected $em;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $entityManager;
    }


    public function onSymfonyComponentSecurityHttpEventLogoutEvent(LogoutEvent $logoutEvent)
    {
        $token = $this->tokenStorage->getToken();

        $tuser = $token->getUser();
        $tconnexionRepository = $this->em->getRepository("App:Tconnexion");
        $tconnexion = $tconnexionRepository->findoneBy(['usrIns' => $tuser->getId()]);

        if ($tconnexion) {
            $this->em->persist($tconnexion);
            $this->em->flush();
        }
    }
}
