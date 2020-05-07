<?php

namespace App\Repository;

use App\Entity\CurrentStateActionPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CurrentStateActionPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrentStateActionPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrentStateActionPlan[]    findAll()
 * @method CurrentStateActionPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrentStateActionPlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrentStateActionPlan::class);
    }

    // /**
    //  * @return CurrentStateActionPlan[] Returns an array of CurrentStateActionPlan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CurrentStateActionPlan
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
