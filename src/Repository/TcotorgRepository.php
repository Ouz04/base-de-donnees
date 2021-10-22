<?php

namespace App\Repository;

use DateTime;
use DateInterval;
use App\Entity\Tcotorg;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tcotorg|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tcotorg|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tcotorg[]    findAll()
 * @method Tcotorg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TcotorgRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tcotorg::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tcotorg[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('a')
            ->join('a.clrCot', 'b')
            ->join('a.clrOrg', 'c');
        // return $this->findAll();
        if (!empty($search->tcotation)) {
            $query = $query
                ->andWhere('b.cod = :cod')
                ->setParameter('cod', "{$search->tcotation}");
        }
        if (!empty($search->cotCod)) {
            $query = $query
                ->andWhere('b.cod like :cod')
                ->setParameter('cod', "%{$search->cotCod}%");
        }
        if (!empty($search->torganisation)) {
            $query = $query
                ->andWhere('c.cod = :cod')
                ->setParameter('cod', "{$search->torganisation}");
        }
        if (!empty($search->cotCod)) {
            $query = $query
                ->andWhere('c.cod like :cod')
                ->setParameter('cod', "%{$search->cotCod}%");
        }

        include "shared/_searchDatCreat.php";

        $query = $query
            ->orderBy('b.cod,c.cod')
            ->setMaxResults(5000);

        if ($search->tcotation or $search->cotCod or $search->torganisation or $search->orgCod or $search->datIns) {
            return $query->getQuery()->getResult();
        } else {
            return $this->findBy(['id' => '-1'], []);
        }
    }
    // /**
    //  * @return Tcotorg[] Returns an array of Tcotorg objects
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
    public function findOneBySomeField($value): ?Tcotorg
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
