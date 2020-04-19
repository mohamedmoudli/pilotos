<?php

namespace App\Repository;

use App\Entity\PerimetrePolitique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PerimetrePolitique|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerimetrePolitique|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerimetrePolitique[]    findAll()
 * @method PerimetrePolitique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerimetrePolitiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerimetrePolitique::class);
    }

    // /**
    //  * @return PerimetrePolitique[] Returns an array of PerimetrePolitique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PerimetrePolitique
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
