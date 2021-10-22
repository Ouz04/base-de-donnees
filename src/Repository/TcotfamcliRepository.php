<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Tcotfamcli;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tcotfamcli|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tcotfamcli|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tcotfamcli[]    findAll()
 * @method Tcotfamcli[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TcotfamcliRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tcotfamcli::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tcotcli[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('a')
            ->join('a.clrCot', 'b')
            ->join('a.clrFamcli', 'c');
        // return $this->findAll();
        if (!empty($search->tcotation)) {
            $query = $query
                ->andWhere('b.cod = :tcotation')
                ->setParameter('tcotation', "{$search->tcotation}");
        }
        if (!empty($search->cotCod) & ($search->cotCod <> '*') ) {
            $query = $query
                ->andWhere('b.cod like :cod')
                ->setParameter('cod', "%{$search->cotCod}%");
        }
        if (!empty($search->tfamcli)) {
            $query = $query
                ->andWhere('c.cod = :cod')
                ->setParameter('cod', "{$search->tfamcli}");
        }

        include "shared/_searchDatCreat.php";


        $query = $query
            ->orderBy('b.cod,c.cod')
            ->setMaxResults(5000);

        if ($search->tcotation or $search->cotCod  or $search->tfamcli or $search->datIns) {
            return $query->getQuery()->getResult();
        } else {
            return $this->findBy(['id' => '-1'], []);
        }
    }
    // /**
    //  * @return Tcotfamcli[] Returns an array of Tcotfamcli objects
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
    public function findOneBySomeField($value): ?Tcotfamcli
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
