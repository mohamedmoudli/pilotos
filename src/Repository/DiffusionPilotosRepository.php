<?php

namespace App\Repository;

use App\Entity\DiffusionPilotos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DiffusionPilotos|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiffusionPilotos|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiffusionPilotos[]    findAll()
 * @method DiffusionPilotos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiffusionPilotosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiffusionPilotos::class);
    }

    // /**
    //  * @return DiffusionPilotos[] Returns an array of DiffusionPilotos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DiffusionPilotos
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
