<?php

namespace App\Repository;

use App\Entity\IntersetedParty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IntersetedParty|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntersetedParty|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntersetedParty[]    findAll()
 * @method IntersetedParty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartieInteresseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IntersetedParty::class);
    }

    public function getCategoryNumber(){
        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\IntersetedParty p left outer JOIN App\Entity\CategoryeInterestedParty c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.NameCategory as Nom')
            ->addSelect('count(p.CategoryInterestedParty) as nbre')
            ->from('App\Entity\CategoryeInterestedParty', 'c')
            ->leftjoin('App\Entity\IntersetedParty', 'p', 'with', 'c.id = p.CategoryInterestedParty')
            ->groupBy('c.id')
            ->getQuery()->getArrayResult();
        return $query;
    }
    public function getInterestedPartyRevelant(int $threshold){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p.id as id,  p.Interest as Interest , p.Influence as Influence , p.Power as Power , p.Weight as Weight , p.NameInterestedParty as NameInterestedParty FROM App\Entity\IntersetedParty p
         join App\Entity\CategoryeInterestedParty c where c.id = p.CategoryInterestedParty
         AND p.Weight  > $threshold
         GROUP BY p.id ");
        return $query->execute();
    }

    public function getpoid(int $seul){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p.id as id, c.NameCategory as nomcat , p.NomPI as NomPI FROM App\Entity\IntersetedParty p
         join App\Entity\CategoryeInterestedParty c where c.id = p.CategoryInterestedParty
         AND p.Poids > $seul
         GROUP BY p.id ");
        return $query->execute();
    }
    public function getNomCategories(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT  p.NameCategory   FROM App\Entity\Categoriepi p
         GROUP BY p.NameCategory ");
        return $query->execute();
    }

    public function getcoutnbCategories(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT c.id as id, c.NameCategory as nomcat, COUNT(p.CategoryInterestedParty) as nbre FROM App\Entity\IntersetedParty p
         join App\Entity\CategoryeInterestedParty c where c.id = p.CategoryInterestedParty
         GROUP BY p.CategoryInterestedParty");
        return $query->execute();
    }

    // /**
    //  * @return IntersetedParty[] Returns an array of IntersetedParty objects
    //  */
    /*
     $em=$this->getDoctrine()->getManager();
$query = $em->createQuery(
            'SELECT count(distinct b.id), count(distinct e.id)
            FROM EnexgirDatabaseBundle:Batiments b, EnexgirDatabaseBundle:Ensembles e, EnexgirDatabaseBundle:Parcsimmobilier p
            WHERE p.id = "1" AND e.parcsimmobilier_id = p.id AND e.id = b.ensembles_id
            ');
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
    public function findOneBySomeField($value): ?IntersetedParty
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
