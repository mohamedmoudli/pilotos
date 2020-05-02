<?php

namespace App\Repository;

use App\Entity\TypeStake;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeStake|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeStake|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeStake[]    findAll()
 * @method TypeStake[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeEnjeuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeStake::class);
    }

    // /**
    //  * @return TypeStake[] Returns an array of TypeStake objects
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
    public function findOneBySomeField($value): ?TypeStake
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
