<?php

namespace App\Repository;

use App\Entity\CategorieOpportunite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategorieOpportunite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieOpportunite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieOpportunite[]    findAll()
 * @method CategorieOpportunite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieOpportuniteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieOpportunite::class);
    }

    // /**
    //  * @return CategorieOpportunite[] Returns an array of CategorieOpportunite objects
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
    public function findOneBySomeField($value): ?CategorieOpportunite
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
