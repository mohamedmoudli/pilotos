<?php

namespace App\Repository;

use App\Entity\ActionPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ActionPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActionPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActionPlan[]    findAll()
 * @method ActionPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanDeActionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActionPlan::class);
    }

    // /**
    //  * @return ActionPlan[] Returns an array of ActionPlan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActionPlan
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
