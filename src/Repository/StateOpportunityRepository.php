<?php

namespace App\Repository;

use App\Entity\StateOpportunity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StateOpportunity|null find($id, $lockMode = null, $lockVersion = null)
 * @method StateOpportunity|null findOneBy(array $criteria, array $orderBy = null)
 * @method StateOpportunity[]    findAll()
 * @method StateOpportunity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StateOpportunityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StateOpportunity::class);
    }

    // /**
    //  * @return StateOpportunity[] Returns an array of StateOpportunity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StateOpportunity
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
