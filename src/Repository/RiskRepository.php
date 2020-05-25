<?php

namespace App\Repository;

use App\Entity\Risk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Risk|null find($id, $lockMode = null, $lockVersion = null)
 * @method Risk|null findOneBy(array $criteria, array $orderBy = null)
 * @method Risk[]    findAll()
 * @method Risk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RiskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Risk::class);
    }

    public function getRisque(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p.id as id , p.Description as Description , p.CourtTerm as CourtTerm ,
        p.MoyenTerm as MoyenTerm , p.LongTerm as LongTerm , p.DateIdentification as DateIdentification ,
        p.Causes as Causes , p.Censequence as Censequence , p.Gravite as Gravite ,
        p.Probabilite as Probabilite , p.detectabilite as detectabilite , p.Criticite as Criticite ,
        p.Decision as Decision , p.StateRisk as StateRisk , p.Commentaire as Commentaire ,
        c.NomCategorie as NomCategorie , t.Process as Process , s.NomSrategique as NomSrategique ,
        a.id as idAction FROM App\Entity\Risque p
         join App\Entity\CategorieRisque c
         join App\Entity\Processus t
         join App\Entity\StrategiqueRisque s
         join App\Entity\PlanDeAction a
            where t.id = p.Process 
            AND  c.id = p.CategoryRisk
            AND  s.id = p.StrategicRisk
            AND p.id = a.Risk
        ");
        return $query->execute();
    }

    public function getStateRiskNumber(){
        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NameStateRisk as Nom')
            ->addSelect('count(p.StateRisk) as nbre')
            ->from('App\Entity\StateRisk', 'c')
            ->leftjoin('App\Entity\Risk', 'p', 'with', 'c.id = p.StateRisk')
            ->groupBy('c.id')
            ->getQuery()->getArrayResult();
        return $query;
    }

    public function getcategoryriskNumber(){
        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NameCategoryRisk as Nom')
            ->addSelect('count(p.CategoryRisk) as nbre')
            ->from('App\Entity\CategoryRisk', 'c')
            ->leftjoin('App\Entity\Risk', 'p', 'with', 'c.id = p.CategoryRisk')
            ->groupBy('c.id')
            ->getQuery()->getArrayResult();
        return $query;
    }
    // /**
    //  * @return CategoriesRisque[] Returns an array of CategoriesRisque objects
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
    public function findOneBySomeField($value): ?CategoriesRisque
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
