<?php

namespace App\Command;

use App\Entity\Agent;
use App\Entity\Service;
use App\Entity\User;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use League\Csv\Statement;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ChargementServicesGensDeMer extends Command
{
    protected static $defaultName = 'app:load-services-gm';
    protected static $defaultDescription = 'Chargement à la volé de services et des agents GM';

    private $entityManager;

    private $encoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        // 3. Update the value of the private entityManager variable through injection
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;

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
        $csv = Reader::createFromPath(__DIR__ .'/dist/agents_gm.csv', 'r');
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0); //set the CSV header offset

        $stmt = Statement::create();
        $records = $stmt->process($csv);

        foreach ($records as $record) {
            if($record['nom'])
            {
                $nom = explode(' ', $record['nom'])[0];
                $prenom = explode(' ', $record['nom'])[1];
                /** @var ServiceRepository $serviceRepository */
                $serviceRepository = $this->entityManager->getRepository(Service::class);
                $service = $serviceRepository->findOneBy(['nom' => trim($record['service_nom'])]);
                $user = new User();
                if(!$service) {
                    $service = new Service();
                    $service->setNom($record['service_nom']);
                }
                $user->setService($service);
                $user->setEmail($record['email'])
                    ->setEnabled(true)
                    ->setUsername($this->generateUsernameFromFullName($prenom, $nom))
                    ->setPassword($this->hashPassword($user))
                    ->addRole('ROLE_GM')
                ;
                $agent = new Agent();
                $agent->setNom($nom)
                    ->setPrenom($prenom)
                    ->setUserAccount($user)
                    ->setDateArrivee(new \DateTimeImmutable())
                ;
                $this->entityManager->persist($agent);
                $this->entityManager->flush();
            }

        }


        $io->success('Les agents Gens de Mer ont été ajoutés en base de données.');

        return 0;
    }


    private function replace_accents($str)
    {
        $str = htmlentities($str, ENT_COMPAT, "UTF-8");
        $str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/','$1',$str);
        $str = str_replace("'", "", $str);
        $str = str_replace(' ', '-', $str);
        return html_entity_decode($str);
    }

    private function generateUsernameFromFullName($firstName, $lastName)
    {
        $firstName = $this->replace_accents($firstName);
        $lastName = $this->replace_accents($lastName);
        return strtolower("${firstName}.${lastName}");
    }

    private function hashPassword(User $user)
    {
        return $this->encoder->encodePassword($user, $user->getUsername());
    }
}
