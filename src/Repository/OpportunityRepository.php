<?php

namespace App\Repository;

use App\Entity\Opportunity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Opportunity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Opportunity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Opportunity[]    findAll()
 * @method Opportunity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpportunityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Opportunity::class);
    }



    public function getNbreEtatOpportunite(){
        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NameStateOpportunity as Nom')
            ->addSelect('count(p.StateOpportunity) as nbre')
            ->from('App\Entity\StateOpportunity', 'c')
            ->leftjoin('App\Entity\Opportunity', 'p', 'with', 'c.id = p.StateOpportunity')
            ->groupBy('c.id')
            ->getQuery()->getArrayResult();
        return $query;
    }

    public function getNbreCategorieOpportunite(){
        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NomCategorie as Nom')
            ->addSelect('count(p.CategoryOpportunity) as nbre')
            ->from('App\Entity\CategoryOpportunity', 'c')
            ->leftjoin('App\Entity\Opportunity', 'p', 'with', 'c.id = p.CategoryOpportunity')
            ->groupBy('c.id')
            ->getQuery()->getArrayResult();
        return $query;
    }

    // /**
    //  * @return Opportunity[] Returns an array of Opportunity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Opportunity
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
