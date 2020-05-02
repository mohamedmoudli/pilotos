<?php

namespace App\Repository;

use App\Entity\HistoricalOpportunity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HistoricalOpportunity|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoricalOpportunity|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoricalOpportunity[]    findAll()
 * @method HistoricalOpportunity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoricalOpportunityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoricalOpportunity::class);
    }

    // /**
    //  * @return HistoricalOpportunity[] Returns an array of HistoricalOpportunity objects
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
    public function findOneBySomeField($value): ?HistoricalOpportunity
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
