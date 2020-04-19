<?php

namespace App\Repository;

use App\Entity\Categoripi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Categoripi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categoripi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categoripi[]    findAll()
 * @method Categoripi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoripiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoripi::class);
    }

    // /**
    //  * @return Categoripi[] Returns an array of Categoripi objects
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
    public function findOneBySomeField($value): ?Categoripi
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
