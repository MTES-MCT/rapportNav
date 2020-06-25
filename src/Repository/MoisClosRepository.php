<?php

namespace App\Repository;

use App\Entity\MoisClos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Service;

/**
 * @method MoisClos|null find($id, $lockMode = null, $lockVersion = null)
 * @method MoisClos|null findOneBy(array $criteria, array $orderBy = null)
 * @method MoisClos[]    findAll()
 * @method MoisClos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoisClosRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, MoisClos::class);
    }
    
    public function findOpenMonths(Service $service, \DateTimeInterface $from, int $depth = 2) : ?Collection {
        $backFromInitialDate = (clone $from)->modify($depth."month ago");
        
        $to = new \DateTimeImmutable("01-".$backFromInitialDate->format("m")."-".$backFromInitialDate->format("Y"));
        
        return $this->createQueryBuilder('mc')
            ->andWhere('mc.service = :service')
            ->andWhere('mc.date <= :fromMonth')
            ->andWhere('mc.date > :to')
            ->setParameters(['service' => $service, 
                    'fromMonth' => $from,
                    'to' => $to])
            ->orderBy('mc.date', 'ASC')
            ->setMaxResults($depth)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function isClosed(Service $service, \DateTimeInterface $date) {
        $result = $this->createQueryBuilder('mc')
            ->andWhere('mc.service = :service')
            ->andWhere('mc.date= :date')
            ->setParameters(['service' => $service, 
                    'date' => $date])
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
        return (bool)($result);
    }

}
