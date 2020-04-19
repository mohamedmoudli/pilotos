<?php

namespace App\Repository;

use App\Entity\PlanDeAction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PlanDeAction|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanDeAction|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanDeAction[]    findAll()
 * @method PlanDeAction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanDeActionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanDeAction::class);
    }

    // /**
    //  * @return PlanDeAction[] Returns an array of PlanDeAction objects
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
    public function findOneBySomeField($value): ?PlanDeAction
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
