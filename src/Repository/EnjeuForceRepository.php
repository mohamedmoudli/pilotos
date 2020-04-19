<?php

namespace App\Repository;

use App\Entity\EnjeuForce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EnjeuForce|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnjeuForce|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnjeuForce[]    findAll()
 * @method EnjeuForce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnjeuForceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnjeuForce::class);
    }

    // /**
    //  * @return EnjeuForce[] Returns an array of EnjeuForce objects
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
    public function findOneBySomeField($value): ?EnjeuForce
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
