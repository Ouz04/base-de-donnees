<?php

namespace App\Repository;

use App\Data\QueryFill;
use App\Data\SearchData;
use App\Entity\Torganisation;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Torganisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Torganisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Torganisation[]    findAll()
 * @method Torganisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TorganisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Torganisation::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Torganisation[]
     */
    public function findSearch(SearchData $search, $idUsr): array
    {

        if (!$idUsr) {
            $query = $this
                ->createQueryBuilder('a');
        } else {
            //dd($idUsr);
            $query = $this
                ->createQueryBuilder('a')
                ->join('App\Entity\Tusrcml', 'usrcml', 'WITH', 'usrcml.clrCml = a.clrCml')
                ->join('usrcml.clrUsr', 'usr')
                ->andWhere('usr.id = :id')
                ->setParameter('id', "{$idUsr}");;
        }
        // dd($query->getQuery()->getResult());
        // return $this->findAll();
        if (!empty($search->orgCod) & $search->orgCod <> '*') {
            $query = $query
                ->andWhere('a.cod like :cod')
                ->setParameter('cod', "%{$search->orgCod}%");
        }
        if (!empty($search->orgNom)) {
            $query = $query
                ->andWhere('a.nom like :nom')
                ->setParameter('nom', "%{$search->orgNom}%");
        }


        //  if (!empty($search->datIns)) {
        //dd($query);
        include "shared/_searchDatCreat.php";
        //$qb = new QueryFill($query);
        //$query = $qb->addWhereDatCreat($search);


        $query = $query
            ->orderBy('a.cod')
            ->setMaxResults(5000);

        if ($search->orgCod or $search->orgNom or $search->datIns) {

            return $query->getQuery()->getResult();
        } else {
            return $this->findBy(['id' => '-1'], []);
        }
    }

    // /**
    //  * @return Torganisation[] Returns an array of Torganisation objects
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
    public function findOneBySomeField($value): ?Torganisation
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
