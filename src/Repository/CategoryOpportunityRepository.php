<?php

namespace App\Repository;

use App\Entity\CategoryOpportunity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryOpportunity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryOpportunity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryOpportunity[]    findAll()
 * @method CategoryOpportunity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryOpportunityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryOpportunity::class);
    }

    // /**
    //  * @return CategoryOpportunity[] Returns an array of CategoryOpportunity objects
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
    public function findOneBySomeField($value): ?CategoryOpportunity
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
