<?php

namespace App\Repository;

use App\Entity\CategoryeInterestedParty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryeInterestedParty|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryeInterestedParty|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryeInterestedParty[]    findAll()
 * @method CategoryeInterestedParty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryeInterestedParty::class);
    }

    // /**
    //  * @return CategoryeInterestedParty[] Returns an array of CategoryeInterestedParty objects
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
    public function findOneBySomeField($value): ?CategoryeInterestedParty
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
