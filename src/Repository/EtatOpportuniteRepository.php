<?php

namespace App\Repository;

use App\Entity\EtatOpportunite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EtatOpportunite|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatOpportunite|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatOpportunite[]    findAll()
 * @method EtatOpportunite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatOpportuniteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatOpportunite::class);
    }

    // /**
    //  * @return EtatOpportunite[] Returns an array of EtatOpportunite objects
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
    public function findOneBySomeField($value): ?EtatOpportunite
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
