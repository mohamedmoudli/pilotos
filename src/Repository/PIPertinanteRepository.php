<?php

namespace App\Repository;

use App\Entity\PIPertinante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PIPertinante|null find($id, $lockMode = null, $lockVersion = null)
 * @method PIPertinante|null findOneBy(array $criteria, array $orderBy = null)
 * @method PIPertinante[]    findAll()
 * @method PIPertinante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PIPertinanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PIPertinante::class);
    }

    // /**
    //  * @return PIPertinante[] Returns an array of PIPertinante objects
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
    public function findOneBySomeField($value): ?PIPertinante
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
