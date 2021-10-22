<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Tgritarpst;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tgritarpst|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tgritarpst|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tgritarpst[]    findAll()
 * @method Tgritarpst[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TgritarpstRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tgritarpst::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tgritarpst[]
     */
    public function findSearch(SearchData $search, $id, int $maxResult): array
    {
        // $queryAll = $this
        //     ->createQueryBuilder('p')
        //     ->andWhere('p.clrGta = :id')
        //     ->setParameter('id', "{$id}");


        $query = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.clrArt', 'a')
            ->leftJoin('a.clrCtgice', 'c')
            ->leftjoin('c.clrNiv1', 'd')
            ->leftJoin('c.clrNiv2', 'e')
            ->leftJoin('a.clrMrqice', 'f')
            ->where('p.clrGta = :id')
            ->setParameter('id', "{$id}");

        // return $this->findAll();
        // dd($query);
        if (!empty($search->codArt)) {
            $query = $query
                ->andWhere('a.cod like :codArt')
                ->setParameter('codArt', "%{$search->codArt}%");
        }
        if (!empty($search->lib)) {
            $query = $query
                ->andWhere('a.libCrtFr  like :lib')
                ->setParameter('lib', "%{$search->lib}%");
        }
        if (!empty($search->tctgice)) {
            $query = $query
                ->andWhere('d.dsg = :tctgice')
                ->setParameter('tctgice', "{$search->tctgice}");
        }
        if (!empty($search->tsctgice)) {
            $query = $query
                ->andWhere('e.dsg = :tsctgice')
                ->setParameter('tsctgice', "{$search->tsctgice}");
        }
        if (!empty($search->tmrqice)) {
            $query = $query
                ->andWhere('f.nom = :tmrqice')
                ->setParameter('tmrqice', "{$search->tmrqice}");
        }
        $query = $query
            // ->orderBy('p.id')
            ->orderBy('a.cod')
            ->setMaxResults($maxResult);

        return $query->getQuery()->getResult();

        // if ($search->codArt or $search->lib or $search->tctgice or $search->tsctgice or $search->tmrqice) {

        //     return $query->getQuery()->getResult();
        // } else {

        //     return $queryAll->getQuery()->getResult();
        // }
    }
    /**
     * récupère tous les produits de la grille
     * @return Tgritarpst[]
     */
    public function getTgritarpst($idGta, $limit)
    {
        $query = $this->createQueryBuilder('a')
            ->leftJoin('a.clrArt', 'b')
            ->andWhere('a.clrGta=:id')
            ->setParameter('id', "{$idGta}")
            ->orderBy('b.cod', 'asc')
            ->setMaxResults($limit);

        return $query->getQuery()->getResult();

    }
    /**
     * recupere les données par page
     * 
     */
    public function getPaginatedTgritarpst($idGta, SearchData $search, $page, $limit)
    {
        $query = $this->createQueryBuilder('p')
            ->leftJoin('p.clrArt', 'b')
            ->leftJoin('p.clrArt', 'a')
            ->leftJoin('a.clrCtgice', 'c')
            ->leftjoin('c.clrNiv1', 'd')
            ->leftJoin('c.clrNiv2', 'e')
            ->leftJoin('a.clrMrqice', 'f')
            ->andWhere('p.clrGta=:id')
            ->setParameter('id', "{$idGta}");


        // return $this->findAll();
        // dd($query);
        if (!empty($search->codArt)) {
            $query = $query
                ->andWhere('a.cod like :codArt')
                ->setParameter('codArt', "%{$search->codArt}%");
        }
        if (!empty($search->lib)) {
            $query = $query
                ->andWhere('a.libCrtFr  like :lib')
                ->setParameter('lib', "%{$search->lib}%");
        }
        if (!empty($search->tctgice)) {
            $query = $query
                ->andWhere('d.dsg = :tctgice')
                ->setParameter('tctgice', "{$search->tctgice}");
        }
        if (!empty($search->tsctgice)) {
            $query = $query
                ->andWhere('e.dsg = :tsctgice')
                ->setParameter('tsctgice', "{$search->tsctgice}");
        }
        if (!empty($search->tmrqice)) {
            $query = $query
                ->andWhere('f.nom = :tmrqice')
                ->setParameter('tmrqice', "{$search->tmrqice}");
        }
        $query = $query
            // ->orderBy('p.id')
            ->orderBy('a.cod', 'asc');
            // ->setFirstResult(($page * $limit) - $limit)
            // ->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }
     /**
     * recupere les données par page
     * 
     */
    public function getTgritarpstPages($idGta, SearchData $search)
    {
        $query = $this->createQueryBuilder('p')
            ->leftJoin('p.clrArt', 'b')
            ->leftJoin('p.clrArt', 'a')
            ->leftJoin('a.clrCtgice', 'c')
            ->leftjoin('c.clrNiv1', 'd')
            ->leftJoin('c.clrNiv2', 'e')
            ->leftJoin('a.clrMrqice', 'f')
            ->andWhere('p.clrGta=:id')
            ->setParameter('id', "{$idGta}");


        // return $this->findAll();
        // dd($query);
        if (!empty($search->codArt)) {
            $query = $query
                ->andWhere('a.cod like :codArt')
                ->setParameter('codArt', "%{$search->codArt}%");
        }
        if (!empty($search->lib)) {
            $query = $query
                ->andWhere('a.libCrtFr  like :lib')
                ->setParameter('lib', "%{$search->lib}%");
        }
        if (!empty($search->tctgice)) {
            $query = $query
                ->andWhere('d.dsg = :tctgice')
                ->setParameter('tctgice', "{$search->tctgice}");
        }
        if (!empty($search->tsctgice)) {
            $query = $query
                ->andWhere('e.dsg = :tsctgice')
                ->setParameter('tsctgice', "{$search->tsctgice}");
        }
        if (!empty($search->tmrqice)) {
            $query = $query
                ->andWhere('f.nom = :tmrqice')
                ->setParameter('tmrqice', "{$search->tmrqice}");
        }
        $query = $query
            // ->orderBy('p.id')
            ->orderBy('a.cod', 'asc');


        return $query->getQuery()->getResult();
    }
    /**
     * retourne total
     */
    public function getCountRqt2($idGta,SearchData $search)
    {

        $query = $this->createQueryBuilder('p')
            ->select('count(p)')
            ->leftJoin('p.clrArt', 'b')
            ->leftJoin('p.clrArt', 'a')
            ->leftJoin('a.clrCtgice', 'c')
            ->leftjoin('c.clrNiv1', 'd')
            ->leftJoin('c.clrNiv2', 'e')
            ->leftJoin('a.clrMrqice', 'f')
            ->andWhere('p.clrGta=:id')
            ->setParameter('id', "{$idGta}");


        // return $this->findAll();
        // dd($query);
        if (!empty($search->codArt)) {
            $query = $query
                ->andWhere('a.cod like :codArt')
                ->setParameter('codArt', "%{$search->codArt}%");
        }
        if (!empty($search->lib)) {
            $query = $query
                ->andWhere('a.libCrtFr  like :lib')
                ->setParameter('lib', "%{$search->lib}%");
        }
        if (!empty($search->tctgice)) {
            $query = $query
                ->andWhere('d.dsg = :tctgice')
                ->setParameter('tctgice', "{$search->tctgice}");
        }
        if (!empty($search->tsctgice)) {
            $query = $query
                ->andWhere('e.dsg = :tsctgice')
                ->setParameter('tsctgice', "{$search->tsctgice}");
        }
        if (!empty($search->tmrqice)) {
            $query = $query
                ->andWhere('f.nom = :tmrqice')
                ->setParameter('tmrqice', "{$search->tmrqice}");
        }


        return $query->getQuery()->getSingleScalarResult();
    }
  /**
     * retourne total
     */
    public function getCountRqt($idGta)
    {

        $query = $this->createQueryBuilder('a')
            ->select('count(a)')
            ->andWhere('a.clrGta=:id')
            ->setParameter('id', "{$idGta}");

        return $query->getQuery()->getSingleScalarResult();
    }    
    // /**
    //  * @return Tgritarpst[] Returns an array of Tgritarpst objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tgritarpst
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

