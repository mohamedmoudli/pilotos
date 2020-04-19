<?php

namespace App\Repository;

use App\Entity\Risque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Risque|null find($id, $lockMode = null, $lockVersion = null)
 * @method Risque|null findOneBy(array $criteria, array $orderBy = null)
 * @method Risque[]    findAll()
 * @method Risque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RisqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Risque::class);
    }

    public function getRisque(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p.id as id , p.Description as Description , p.CourtTerm as CourtTerm ,
        p.MoyenTerm as MoyenTerm , p.LongTerm as LongTerm , p.DateIdentification as DateIdentification ,
        p.Causes as Causes , p.Censequence as Censequence , p.Gravite as Gravite ,
        p.Probabilite as Probabilite , p.detectabilite as detectabilite , p.Criticite as Criticite ,
        p.Decision as Decision , p.EtatRisque as EtatRisque , p.Commentaire as Commentaire ,
        c.NomCategorie as NomCategorie , t.Processus as Processus , s.NomSrategique as NomSrategique ,
        a.id as idAction FROM App\Entity\Risque p
         join App\Entity\CategorieRisque c
         join App\Entity\Processus t
         join App\Entity\StrategiqueRisque s
         join App\Entity\PlanDeAction a
            where t.id = p.Processus 
            AND  c.id = p.CategorieRisque
            AND  s.id = p.StrategiqueRisque
            AND p.id = a.Risque
        ");
        return $query->execute();
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
