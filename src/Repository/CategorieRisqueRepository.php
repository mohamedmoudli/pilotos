<?php

namespace App\Repository;

use App\Entity\CategorieRisque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategorieRisque|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieRisque|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieRisque[]    findAll()
 * @method CategorieRisque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRisqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieRisque::class);
    }

    // /**
    //  * @return CategorieRisque[] Returns an array of CategorieRisque objects
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
    public function findOneBySomeField($value): ?CategorieRisque
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
