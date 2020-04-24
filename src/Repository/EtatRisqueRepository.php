<?php

namespace App\Repository;

use App\Entity\EtatRisque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EtatRisque|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatRisque|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatRisque[]    findAll()
 * @method EtatRisque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatRisqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatRisque::class);
    }

    // /**
    //  * @return EtatRisque[] Returns an array of EtatRisque objects
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
    public function findOneBySomeField($value): ?EtatRisque
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
