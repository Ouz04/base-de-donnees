<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Tctgicearb;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tctgicearb|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tctgicearb|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tctgicearb[]    findAll()
 * @method Tctgicearb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TctgicearbRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tctgicearb::class);
    }
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('a')
            ->leftjoin('a.clrNiv1', 'd')
            ->leftjoin('a.clrNiv2', 'e');
        // return $this->findAll();
        // dump($search->tctgice);
        if (!empty($search->tctgice)) {
            $query = $query
                ->andWhere('d.id = :tctgice')
                ->setParameter('tctgice', "{$search->tctgice->getId()}");
        }
        if (!empty($search->tsctgice)) {
            $query = $query->andWhere('e.id = :tsctgice')
                ->setParameter('tsctgice', "{$search->tsctgice->getId()}");
        }


        $query = $query
            ->orderBy('a.clrNiv1')
            ->setMaxResults(1000);

        if ($search->tctgice or $search->tsctgice) {
            dump($query->getQuery());

            return $query->getQuery()->getResult();
        } else {
            return $this->findAll();
        }
    }


    // /**
    //  * @return Tctgicearb[] Returns an array of Tctgicearb objects
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
    public function findOneBySomeField($value): ?Tctgicearb
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
