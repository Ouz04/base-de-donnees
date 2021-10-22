<?php

namespace App\Repository;

use DateTime;
use DateInterval;
use App\Entity\Tcotcli;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tcotcli|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tcotcli|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tcotcli[]    findAll()
 * @method Tcotcli[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TcotcliRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tcotcli::class);
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
            ->join('a.clrCli', 'c');
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


        if (!empty($search->tclient)) {
            $query = $query
                ->andWhere('c.cod = :tclient')
                ->setParameter('tclient', "{$search->tclient}");
        }

        if (!empty($search->cliCod) ) {
            $query = $query
                ->andWhere('c.cod like :cod')
                ->setParameter('cod', "%{$search->cotCod}%");
        }
        include "shared/_searchDatCreat.php";


        $query = $query
            ->orderBy('b.cod,c.cod')
            ->setMaxResults(5000);

            dump($search->cliCod);
            dump($query->getQuery());
        if ($search->tcotation or $search->cotCod or $search->tclient or $search->cliCod or $search->datIns) {
            return $query->getQuery()->getResult();
        } else {
            return $this->findBy(['id' => '-1'], []);
        }
    }

    // /**
    //  * @return Tcotcli[] Returns an array of Tcotcli objects
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
    public function findOneBySomeField($value): ?Tcotcli
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
