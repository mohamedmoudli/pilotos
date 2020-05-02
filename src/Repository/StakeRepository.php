<?php

namespace App\Repository;

use App\Entity\Stake;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Stake|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stake|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stake[]    findAll()
 * @method Stake[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StakeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stake::class);
    }


    public function getEnjeuForce($force){
        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query1 = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NomCategories as Nom')
            ->addSelect('p.Description as description')
            ->addSelect('p.id as idenjeu')
            ->addSelect('p.Type as type')
            ->from('App\Entity\CategoryStakeInternal', 'c')
            ->leftjoin('App\Entity\Stake', 'p', 'with', 'c.id = p.CategoriesEnjeu' )
            ->andWhere('p.Type = :force')
            ->setParameter("force",$force)
            ->groupBy('p.id')
            ->getQuery()->getArrayResult();

        $query2 = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NomCategories as Nom')
            ->from('App\Entity\CategoryStakeInternal', 'c')
            ->leftjoin('App\Entity\Stake', 'p', 'with', 'c.id = p.CategoriesEnjeu' )
            ->andWhere('p.Type != :force')
            ->orWhere('p.CategoriesEnjeu is null')
            ->setParameter("force",$force)
            ->getQuery()->getArrayResult();

        $query = array_merge($query1, $query2);

        return $query;
    }
    public function getcoutType(){

            $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
            $query = $em->createQueryBuilder()->select('c.id as id')
                ->addSelect('c.NameType as Type')
                ->addSelect('count(p.Type) as nbre')
                ->from('App\Entity\TypeStake', 'c')
                ->leftjoin('App\Entity\Stake', 'p', 'with', 'c.id = p.Type')
                ->groupBy('c.id')
                ->getQuery()->getArrayResult();
            return $query;

    }













    public function getEnjeuForcequery($force , $faiblesses , $Opportunite, $Menaces){
        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query1 = $em->createQueryBuilder()->select('c.Type as type')
            ->addSelect('COUNT(c.Type) as count')
            ->from('App\Entity\Stake', 'c')
            ->Where('c.Type = :force')
            ->setParameter("force",$force)
            ->getQuery()->getArrayResult();
        $query2 = $em->createQueryBuilder()->select('c.Type as type')
            ->addSelect('COUNT(c.Type) as count')
            ->from('App\Entity\Stake', 'c')
            ->Where('c.Type = :Menaces')
            ->setParameter("Menaces",$Menaces)
            ->getQuery()->getArrayResult();

        $query31 = $em->createQueryBuilder()->select('COUNT(c.Type)')
            ->from('App\Entity\Stake', 'c')
            ->Where('c.Type = :faiblesses')
            ->setParameter("faiblesses",$faiblesses)
            ->getQuery()->getArrayResult();
        $query3 = array("Type" =>"faiblesses" , $query31);
        $query4 = $em->createQueryBuilder()->select('c.Type as type')
            ->addSelect('COUNT(c.Type) as count')
            ->from('App\Entity\Stake', 'c')
            ->Where('c.Type = :Opportunity')
            ->setParameter("Opportunity",$Opportunite)

            ->getQuery()->getArrayResult();
        $query = array_merge($query1 , $query2 , $query3 , $query4);

        return $query;
    }

    // /**
    //  * @return Stake[] Returns an array of Stake objects
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
    public function findOneBySomeField($value): ?Stake
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
