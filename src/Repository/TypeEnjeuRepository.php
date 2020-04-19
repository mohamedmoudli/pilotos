<?php

namespace App\Repository;

use App\Entity\TypeEnjeu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeEnjeu|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeEnjeu|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeEnjeu[]    findAll()
 * @method TypeEnjeu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeEnjeuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeEnjeu::class);
    }

    // /**
    //  * @return TypeEnjeu[] Returns an array of TypeEnjeu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeEnjeu
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
