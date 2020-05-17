<?php

namespace App\Repository;

use App\Entity\ActionPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ActionPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActionPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActionPlan[]    findAll()
 * @method ActionPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanDeActionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActionPlan::class);
    }

    public function getCountStateEfficacity(){

        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NameStateEfficacy as Type')
            ->addSelect('count(p.stateEfficacyActionPlan) as nbre')
            ->from('App\Entity\StateEfficacyActionPlan', 'c')
            ->leftjoin('App\Entity\ActionPlan', 'p', 'with', 'c.id = p.stateEfficacyActionPlan')
            ->groupBy('c.id')
            ->getQuery()->getArrayResult();
        return $query;

    }

    public function getCountCurrentState(){

        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NameCurrentState as Type')
            ->addSelect('count(p.currentStateActionPlan) as nbre')
            ->from('App\Entity\CurrentStateActionPlan', 'c')
            ->leftjoin('App\Entity\ActionPlan', 'p', 'with', 'c.id = p.currentStateActionPlan')
            ->groupBy('c.id')
            ->getQuery()->getArrayResult();
        return $query;



    }
    public function getCountCurrentStatebyProcess()
    {

        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NameCurrentState as Type')
            ->addSelect('s.Process as Process')
            ->addSelect('count(p.currentStateActionPlan) as nbre')
            ->from('App\Entity\CurrentStateActionPlan', 'c')
            ->join('App\Entity\ActionPlan', 'p', 'with', 'c.id = p.currentStateActionPlan')
            ->join('App\Entity\Process', 's', 'with', 's.id = p.Process')
            ->groupBy('s.id' , 'c.id'  )
            ->getQuery()->getArrayResult();
        return $query;
    }

    public function getAdvencementbyProcess()
    {

        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('p.id as id')
            ->addSelect('s.Process as process')
            ->addSelect('AVG(p.Advancement) as avencement')
            ->from('App\Entity\Process', 's')
            ->join('App\Entity\ActionPlan', 'p', 'with', 's.id = p.Process')
            ->groupBy('s.id' )
            ->getQuery()->getArrayResult();
        return $query;
    }

    public function getAdvencementbyProcessbyTimeLimit()
    {

        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('s.id as id')
            ->addSelect('s.Process as process')
            ->addSelect('p.Delai as Delai')
            ->addSelect('AVG(p.Advancement) as moyAdvancement')
            ->addSelect('p.Advancement as Advancement')
            ->from('App\Entity\Process', 's')
            ->leftJoin('App\Entity\ActionPlan', 'p', 'with', 's.id = p.Process')
            ->groupBy('p.id' )
            ->getQuery()->getArrayResult();
        return $query;
    }


    // /**
    //  * @return ActionPlan[] Returns an array of ActionPlan objects
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
    public function findOneBySomeField($value): ?ActionPlan
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
