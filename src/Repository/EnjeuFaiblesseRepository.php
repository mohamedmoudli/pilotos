<?php

namespace App\Repository;

use App\Entity\EnjeuFaiblesse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EnjeuFaiblesse|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnjeuFaiblesse|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnjeuFaiblesse[]    findAll()
 * @method EnjeuFaiblesse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnjeuFaiblesseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnjeuFaiblesse::class);
    }

    // /**
    //  * @return EnjeuFaiblesse[] Returns an array of EnjeuFaiblesse objects
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
    public function findOneBySomeField($value): ?EnjeuFaiblesse
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
