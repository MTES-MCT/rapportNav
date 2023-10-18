<?php

namespace App\Command;

use App\Entity\PAM\PamPlanning;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MissionPamFinNotificationCommand extends Command
{

    protected static $defaultName = 'app:pam:mission-fin-notification';
    protected static $defaultDescription = 'Notification des PAM de leurs fin de mission';

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

        /** @var PamPlanning[] $plannings */
        $plannings = $this->entityManager->getRepository(PamPlanning::class)->missionACloturer();


        foreach($plannings as $planning) {
            $serviceNom = $planning->getService()->getNom();
            $subject = "Votre mission à bord du ${serviceNom} est terminée : avez-vous pensé à Rapportnav ?";
            $email = (new TemplatedEmail())
                ->from('aleck.vincent@beta.gouv.fr')
                ->to($planning->getEmail())
                ->subject($subject)
                ->htmlTemplate('pam/email/notification-fin-mission.html.twig')
                ->context([
                    'service' => $planning->getService()
                ])
            ;
            try {
                $this->mailer->send($email);
                $io->success('Les emails ont été envoyé');
                $this->logger->info('Les emails ont été envoyé');
            } catch(TransportExceptionInterface $e) {
                $this->logger->error($e->getMessage());
            }
        }

        return 0;

    }
}