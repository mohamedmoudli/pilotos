<?php

namespace App\Repository;

use App\Entity\StrategiqueRisque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StrategiqueRisque|null find($id, $lockMode = null, $lockVersion = null)
 * @method StrategiqueRisque|null findOneBy(array $criteria, array $orderBy = null)
 * @method StrategiqueRisque[]    findAll()
 * @method StrategiqueRisque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StrategiqueRisqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StrategiqueRisque::class);
    }

    // /**
    //  * @return StrategiqueRisque[] Returns an array of StrategiqueRisque objects
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
    public function findOneBySomeField($value): ?StrategiqueRisque
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
