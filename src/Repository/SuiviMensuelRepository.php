<?php

namespace App\Repository;

use App\Entity\SuiviMensuel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SuiviMensuel|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuiviMensuel|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuiviMensuel[]    findAll()
 * @method SuiviMensuel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuiviMensuelRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, SuiviMensuel::class);
    }
}
