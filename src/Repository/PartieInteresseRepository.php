<?php

namespace App\Repository;

use App\Entity\Partieinteresse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Partieinteresse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partieinteresse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partieinteresse[]    findAll()
 * @method Partieinteresse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartieInteresseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partieinteresse::class);
    }

    public function getNbreCategories(){
        $em = $this->getEntityManager();
//        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre
//        FROM App\Entity\Partieinteresse p left outer JOIN App\Entity\Categoriepi c where c.id = p.CategoriesPI GROUP BY p.CategoriesPI");
//        return $query->execute();
        $query = $em->createQueryBuilder()->select('c.id as id')
            ->addSelect('c.nomcat as Nom')
            ->addSelect('count(p.CategoriesPI) as nbre')
            ->from('App\Entity\Categoriepi', 'c')
            ->leftjoin('App\Entity\Partieinteresse', 'p', 'with', 'c.id = p.CategoriesPI')
            ->groupBy('c.id')
            ->getQuery()->getArrayResult();
        return $query;
    }
    public function getPIpertinante(int $seul){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p.id as id,  p.interet as interet , p.Influence as Influence , p.Pouvoir as Pouvoir , p.Poids as Poids , p.NomPI as NomPI FROM App\Entity\Partieinteresse p
         join App\Entity\Categoriepi c where c.id = p.CategoriesPI
         AND p.Poids > $seul
         GROUP BY p.id ");
        return $query->execute();
    }

    public function getpoid(int $seul){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p.id as id, c.nomcat as nomcat , p.NomPI as NomPI FROM App\Entity\Partieinteresse p
         join App\Entity\Categoriepi c where c.id = p.CategoriesPI
         AND p.Poids > $seul
         GROUP BY p.id ");
        return $query->execute();
    }
    public function getNomCategories(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT  p.nomcat   FROM App\Entity\Categoriepi p
         GROUP BY p.nomcat ");
        return $query->execute();
    }

    public function getcoutnbCategories(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT c.id as id, c.nomcat as nomcat, COUNT(p.CategoriesPI) as nbre FROM App\Entity\Partieinteresse p
         join App\Entity\Categoriepi c where c.id = p.CategoriesPI
         GROUP BY p.CategoriesPI");
        return $query->execute();
    }

    // /**
    //  * @return Partieinteresse[] Returns an array of Partieinteresse objects
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
    public function findOneBySomeField($value): ?Partieinteresse
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
