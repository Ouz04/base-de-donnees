<?php

namespace App\Repository;

use DateTime;
use DateInterval;
use App\Data\QueryFill;
use App\Entity\Tmodele;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tmodele|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tmodele|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tmodele[]    findAll()
 * @method Tmodele[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TmodeleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tmodele::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tmodele[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('a');
        // return $this->findAll();
        if (!empty($search->mdlCod) & $search->mdlCod <> '*') {
            $query = $query
                ->andWhere('a.cod like :cod')
                ->setParameter('cod', "%{$search->mdlCod}%");
        }
        $qb = new QueryFill($query);
        $query = $qb->addWhereDatCreat($search);


        $query = $query
            ->orderBy('a.cod')
            ->setMaxResults(5000);

        if ($search->mdlCod or $search->datIns) {
            return $query->getQuery()->getResult();
        } else {
            return $this->findBy(['id' => '-1'], []);
        }
    }

    // /**
    //  * @return Tmodele[] Returns an array of Tmodele objects
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
    public function findOneBySomeField($value): ?Tmodele
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
