<?php

namespace App\Repository;

use App\Entity\Tclient;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tclient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tclient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tclient[]    findAll()
 * @method Tclient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TclientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tclient::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tclient[]
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
        // dd($query);
        // dd($query->getQuery()->getResult());
        // return $this->findAll();

        if (!empty($search->cliCod) & $search->cliCod <> '*') {

            $query = $query
                ->andWhere('a.cod like :cod')
                ->setParameter('cod', "%{$search->cliCod}%");
        }
        if (!empty($search->cliNom)) {

            $query = $query
                ->andWhere('a.nom like :nom')
                ->setParameter('nom', "%{$search->cliNom}%");
        }


        //  if (!empty($search->datIns)) {
        //dd($query);
        include "shared/_searchDatCreat.php";
        //$qb = new QueryFill($query);
        //$query = $qb->addWhereDatCreat($search);


        $query = $query
            ->orderBy('a.cod')
            ->setMaxResults(5000);

        if ($search->cliCod or $search->cliNom or $search->datIns) {

            return $query->getQuery()->getResult();
        } else {
            return $this->findBy(['id' => '-1'], []);
        }
    }

    // /**
    //  * @return Tclient[] Returns an array of Tclient objects
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
    public function findOneBySomeField($value): ?Tclient
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
