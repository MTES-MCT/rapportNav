<?php

namespace App\Command;

use App\Entity\FonctionAgent;
use App\Entity\PAM\PamEquipageAgent;
use App\Repository\FonctionAgentRepository;
use App\Repository\PAM\PamEquipageAgentRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ResetFonctionAgentCommand extends Command
{
    protected static $defaultName = 'app:reset-fonction-agent';
    protected static $defaultDescription = 'Add a short description for your command';
    private $fonctionAgentRepository;
    private $equipageRepository;

    public function __construct(FonctionAgentRepository $fonctionAgentRepository, PamEquipageAgentRepository $equipageRepository)
    {
        $this->fonctionAgentRepository = $fonctionAgentRepository;
        $this->equipageRepository = $equipageRepository;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $fonctionsAgent = $this->fonctionAgentRepository->findBy(['nom' => '']);
        $equipages = [];
        foreach($fonctionsAgent as $fonction) {
            $tmp = $this->equipageRepository->findBy(['fonction' => $fonction->getId()]);
            foreach($tmp as $item) {
                $equipages[] = $item;
            }
        }

        $fonctionNonPrecise = new FonctionAgent();
        $fonctionNonPrecise->setNom('Non précisé');
        $this->fonctionAgentRepository->add($fonctionNonPrecise, true);

        foreach($equipages as $equipage) {
            $equipage->setFonction($fonctionNonPrecise);
            $this->equipageRepository->add($equipage, true);
        }


        foreach($fonctionsAgent as $fonction) {
            $this->fonctionAgentRepository->remove($fonction, true);
        }

        $io->success('Les fonctions agents ont été réinitialisés.');

        return 0;

    }
}
