<?php

namespace App\Repository;

use App\Entity\ExigencyInterestedParty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ExigencyInterestedParty|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExigencyInterestedParty|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExigencyInterestedParty[]    findAll()
 * @method ExigencyInterestedParty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExigencyInterestedPartyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExigencyInterestedParty::class);
    }

    // /**
    //  * @return ExigencyInterestedParty[] Returns an array of ExigencyInterestedParty objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExigencyInterestedParty
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
