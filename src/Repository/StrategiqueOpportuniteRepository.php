<?php

namespace App\Repository;

use App\Entity\StrategiqueOpportunite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StrategiqueOpportunite|null find($id, $lockMode = null, $lockVersion = null)
 * @method StrategiqueOpportunite|null findOneBy(array $criteria, array $orderBy = null)
 * @method StrategiqueOpportunite[]    findAll()
 * @method StrategiqueOpportunite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StrategiqueOpportuniteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StrategiqueOpportunite::class);
    }

    // /**
    //  * @return StrategiqueOpportunite[] Returns an array of StrategiqueOpportunite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StrategiqueOpportunite
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
