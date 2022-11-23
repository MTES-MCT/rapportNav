<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ResetRolesCommand extends Command
{
    protected static $defaultName = 'app:reset-roles';
    protected static $defaultDescription = 'Ajout des rôles ULAM ou PAM aux différents comptes utilisateurs';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        // 3. Update the value of the private entityManager variable through injection
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        /** @var User[] $users */
        $users = $this->entityManager->getRepository(User::class)->findAll();

        foreach($users as $user) {
            if($user->getService()) {
                $nomService = $user->getService()->getNom();
                $prefixNomService = explode('_', $nomService)[0];

                if($prefixNomService === 'ULAM') {
                    $user->addRole('ROLE_ULAM');
                }
                if($prefixNomService === 'PAM') {
                    $user->addRole('ROLE_PAM');
                }
            }

        }

        $this->entityManager->flush();
        $io->success('Les rôles ULAM et PAM ont été attribués.');

        return 0;
    }
}
