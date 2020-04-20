<?php

namespace App\Repository;

use App\Entity\HistoriqueOpportunite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HistoriqueOpportunite|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoriqueOpportunite|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoriqueOpportunite[]    findAll()
 * @method HistoriqueOpportunite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoriqueOpportuniteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoriqueOpportunite::class);
    }

    // /**
    //  * @return HistoriqueOpportunite[] Returns an array of HistoriqueOpportunite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HistoriqueOpportunite
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
