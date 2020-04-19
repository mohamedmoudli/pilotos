<?php

namespace App\Repository;

use App\Entity\Exigencepi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Exigencepi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exigencepi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exigencepi[]    findAll()
 * @method Exigencepi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExigencePIRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exigencepi::class);
    }

    // /**
    //  * @return Exigencepi[] Returns an array of Exigencepi objects
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
    public function findOneBySomeField($value): ?Exigencepi
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
