<?php

namespace App\Repository;

use App\Entity\HistoricalRisk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HistoricalRisk|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoricalRisk|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoricalRisk[]    findAll()
 * @method HistoricalRisk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoricalRiskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoricalRisk::class);
    }

    // /**
    //  * @return HistoricalRisk[] Returns an array of HistoricalRisk objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HistoricalRisk
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
