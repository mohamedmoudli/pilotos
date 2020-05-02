<?php

namespace App\Repository;

use App\Entity\CategoryStakeInternal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryStakeInternal|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryStakeInternal|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryStakeInternal[]    findAll()
 * @method CategoryStakeInternal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryStakeInternalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryStakeInternal::class);
    }

    // /**
    //  * @return CategoryStakeInternal[] Returns an array of CategoryStakeInternal objects
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
    public function findOneBySomeField($value): ?CategoryStakeInternal
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
