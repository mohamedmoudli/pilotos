<?php

namespace App\Repository;

use App\Entity\StrategicOpportunity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StrategicOpportunity|null find($id, $lockMode = null, $lockVersion = null)
 * @method StrategicOpportunity|null findOneBy(array $criteria, array $orderBy = null)
 * @method StrategicOpportunity[]    findAll()
 * @method StrategicOpportunity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StrategicOpportunityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StrategicOpportunity::class);
    }

    // /**
    //  * @return StrategicOpportunity[] Returns an array of StrategicOpportunity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StrategicOpportunity
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
