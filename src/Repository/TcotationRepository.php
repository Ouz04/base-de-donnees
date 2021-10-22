<?php

namespace App\Repository;

use DateTime;
use DateInterval;
use App\Data\SearchData;
use App\Entity\Tcotation;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tcotation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tcotation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tcotation[]    findAll()
 * @method Tcotation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TcotationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tcotation::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tmodele[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('a')
            ->leftjoin('a.clrFou', 'f');
        // return $this->findAll();
        if (!empty($search->cotCod) & $search->cotCod <> '*') {
            $query = $query
                ->andWhere('a.cod like :cod')
                ->setParameter('cod', "%{$search->mdlCod}%");
        }
        if (!empty($search->cotDsg)) {
            $query = $query
                ->andWhere('a.dsg like :dsg')
                ->setParameter('dsg', "%{$search->cotDsg}%");
        }
        if (!empty($search->tfournisseur)) {
            $query = $query
                ->andWhere('f.rso = :tfournisseur')
                ->setParameter('tfournisseur', "{$search->tfournisseur}");
        }
        if (!empty($search->datIns)) {

            $datStr = date_format($search->datIns, 'Y-m-d');
            $datj1 = new DateTime($datStr);
            $datj1->add(new DateInterval('P1D'));
            $datStrj1 = date_format($datj1, 'Y-m-d');;
            $query = $query
                ->andWhere('a.datIns >= :dat')
                ->setParameter('dat', "{$datStr}");

            // $query = $query
            //     ->andWhere('a.datIns < :dat')
            //     ->setParameter('dat', "{$datStrj1}");
        }
        $query = $query
            ->orderBy('a.cod')
            ->setMaxResults(5000);

        if ($search->cotCod or $search->cotDsg or $search->tfournisseur or $search->datIns) {
            return $query->getQuery()->getResult();
        } else {
            return $this->findBy(['id' => '-1'], []);
        }
    }

    // /**
    //  * @return Tcotation[] Returns an array of Tcotation objects
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
    public function findOneBySomeField($value): ?Tcotation
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
