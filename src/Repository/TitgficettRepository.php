<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Titgficett;
use App\SpecClass\Reponse;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Titgficett|null find($id, $lockMode = null, $lockVersion = null)
 * @method Titgficett|null findOneBy(array $criteria, array $orderBy = null)
 * @method Titgficett[]    findAll()
 * @method Titgficett[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TitgficettRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Titgficett::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tmodele[]
     */
    public function findSearch(SearchData $search, int $maxResult, Reponse $reponse): array
    {
        $query = $this
            ->createQueryBuilder('a')
            ->join('a.clrTif', 'b');
        // return $this->findAll();
        if (!empty($search->typitgfic) & $search->ttypitgfic <> '*') {
            $query = $query
                ->andWhere('b.dsg = :dsg')
                ->setParameter('dsg', "{$search->ttypitgfic}");
        }

        include "shared/_searchDatCreat.php";


        $query = $query
            ->orderBy('a.datIns', 'DESC')
            ->setMaxResults($maxResult);

        if ($search->ttypitgfic or $search->datIns) {
            $reponse->setVar01('OK');
            return $query->getQuery()->getResult();
        } else {
            $reponse->setVar01('KO');
            return $this->findBy(['id' => '-1'], []);
        }
    }

    // /**
    //  * @return Titgficett[] Returns an array of Titgficett objects
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
    public function findOneBySomeField($value): ?Titgficett
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
