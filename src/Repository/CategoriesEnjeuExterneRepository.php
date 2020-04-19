<?php

namespace App\Repository;

use App\Entity\CategoriesEnjeuExterne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoriesEnjeuExterne|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriesEnjeuExterne|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriesEnjeuExterne[]    findAll()
 * @method CategoriesEnjeuExterne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesEnjeuExterneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriesEnjeuExterne::class);
    }

    // /**
    //  * @return CategoriesEnjeuExterne[] Returns an array of CategoriesEnjeuExterne objects
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
    public function findOneBySomeField($value): ?CategoriesEnjeuExterne
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
