<?php

namespace App\Command;

use App\Entity\PAM\PamPlanning;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MissionNotificationTestCommand extends Command
{

    protected static $defaultName = 'app:pam:mission-test-notification';
    protected static $defaultDescription = 'Notification des PAM de leurs début de mission';

    private EntityManagerInterface $entityManager;

   private MailerInterface  $mailer;

   private LoggerInterface $logger;

    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
        $this->logger = $logger;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $io = new SymfonyStyle($input, $output);

      $email = (new Email())
        ->from('rapportnav.csam@developpement-durable.gouv.fr')
        ->to('camille.nguyen@developpement-durable.gouv.fr')
        ->cc('aleck.vincent@beta.gouv.fr')
        //->bcc('bcc@example.com')
        ->replyTo('aleck.vincent@beta.gouv.fr')
        ->priority(Email::PRIORITY_HIGH)
        ->subject('Test EMAIL postfix DAM')
        ->text('Hello World')
        ->html('<p>RapportNav</p>');

      try {
        $this->mailer->send($email);
        $io->success('Email envoyé');
        $this->logger->info('Email envoyé');
      } catch(TransportExceptionInterface $e) {
        $io->error($e->getMessage());
      }

        return 0;

    }
}
