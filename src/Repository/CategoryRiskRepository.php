<?php

namespace App\Repository;

use App\Entity\CategoryRisk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryRisk|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryRisk|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryRisk[]    findAll()
 * @method CategoryRisk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRiskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryRisk::class);
    }

    // /**
    //  * @return CategoryRisk[] Returns an array of CategoryRisk objects
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
    public function findOneBySomeField($value): ?CategoryRisk
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
