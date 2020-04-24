<?php

namespace App\Repository;

use App\Entity\Opportunite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Opportunite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Opportunite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Opportunite[]    findAll()
 * @method Opportunite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpportuniteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Opportunite::class);
    }



    public function getNbreEtatOpportunite(){
        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\Partieinteresse p left outer JOIN App\Entity\Categoriepi c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NomEtatOpportunite as Nom')
            ->addSelect('count(p.Etatopportunite) as nbre')
            ->from('App\Entity\EtatOpportunite', 'c')
            ->leftjoin('App\Entity\Opportunite', 'p', 'with', 'c.id = p.Etatopportunite')
            ->groupBy('c.id')
            ->getQuery()->getArrayResult();
        return $query;
    }

    public function getNbreCategorieOpportunite(){
        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\Partieinteresse p left outer JOIN App\Entity\Categoriepi c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NomCategorie as Nom')
            ->addSelect('count(p.CategorieOpportunite) as nbre')
            ->from('App\Entity\CategorieOpportunite', 'c')
            ->leftjoin('App\Entity\Opportunite', 'p', 'with', 'c.id = p.CategorieOpportunite')
            ->groupBy('c.id')
            ->getQuery()->getArrayResult();
        return $query;
    }

    // /**
    //  * @return Opportunite[] Returns an array of Opportunite objects
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
    public function findOneBySomeField($value): ?Opportunite
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
