<?php

namespace App\Repository;

use App\Entity\CategoryStakeExternal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryStakeExternal|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryStakeExternal|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryStakeExternal[]    findAll()
 * @method CategoryStakeExternal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryStakeExternalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryStakeExternal::class);
    }

    // /**
    //  * @return CategoryStakeExternal[] Returns an array of CategoryStakeExternal objects
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
    public function findOneBySomeField($value): ?CategoryStakeExternal
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
