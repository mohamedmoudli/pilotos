<?php

namespace App\Repository;

use App\Entity\HistoricalIntersetedParty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HistoricalIntersetedParty|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoricalIntersetedParty|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoricalIntersetedParty[]    findAll()
 * @method HistoricalIntersetedParty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoricalInterestedPartyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoricalIntersetedParty::class);
    }

    // /**
    //  * @return HistoricalIntersetedParty[] Returns an array of HistoricalIntersetedParty objects
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
    public function findOneBySomeField($value): ?HistoricalIntersetedParty
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
