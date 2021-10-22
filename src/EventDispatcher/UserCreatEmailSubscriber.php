<?php

namespace App\EventDispatcher;

use App\Event\UsrCreatEvent;

use Psr\Log\LoggerInterface;
use App\Event\UsrInitPwdEvent;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserCreatEmailSubscriber implements EventSubscriberInterface
{
    protected $logger;
    protected $mailer;
    public function __construct(LoggerInterface $logger, MailerInterface $mailer)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }
    public static function getSubscribedEvents()
    {
        return [
            'usrCreat.success'  => 'sendEmailUsrCreat',
            'usrInitPwd.success'  => 'sendEmailInitPwd'
        ];
    }
    public function sendEmailUsrCreat(UsrCreatEvent $usrCreatEvent)
    {

        $this->logger->info("Email envoyé lors création utilisateur" . $usrCreatEvent->getTuser()->getNom());
        $email = new TemplatedEmail();
        $email->from(new Address("jouanolivier@sfr.fr", "dyadem informatique"))
        ->to($usrCreatEvent->getTuser()->getEmail())
            ->htmlTemplate('email/user_creat.html.twig')
            ->context([
                'tuser' => $usrCreatEvent->getTuser(),
                'pwd' => $usrCreatEvent->getPwd()
            ])
            ->subject("Création compte sur la BDDU");
        $this->mailer->send($email);
    }
    public function sendEmailInitPwd(UsrInitPwdEvent $usrInitPwdEvent)
    {
        // dd($usrCreatEvent);
        $this->logger->info("Email envoyé lors initialisation mot de passe" . $usrInitPwdEvent->getTuser()->getNom());
        $email = new TemplatedEmail();
        $email->from(new Address("jouanolivier@sfr.fr", "initialisation mot de passe"))
        ->to("olivier.jouan@dyadem.fr")
        ->htmlTemplate('email/user_init_pwd.html.twig')
        ->context(['tuser' => $usrInitPwdEvent->getTuser(),
            'url' => $usrInitPwdEvent->getUrl()
        ])
            ->subject("initialisation du mot de passe");
        $this->mailer->send($email);
    }
}
