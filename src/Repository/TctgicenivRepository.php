<?php

namespace App\Repository;

use DateTime;
use DateInterval;
use App\Data\SearchData;
use App\Entity\Tctgiceniv;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tctgiceniv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tctgiceniv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tctgiceniv[]    findAll()
 * @method Tctgiceniv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TctgicenivRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tctgiceniv::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tctgiceniv[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('a');
        // return $this->findAll();

        if (!empty($search->tctgice)) {
            $query = $query
                ->andWhere('a.dsg = :tctgice')
                ->setParameter('tctgice', "{$search->tctgice}");
        }
        if (!empty($search->ctgiceDsg)) {
            $query = $query->andWhere('a.dsg like :ctgiceDsg')
                ->setParameter('ctgiceDsg', "%{$search->ctgiceDsg}%");
        }
        if (!empty($search->niv)) {
            $query = $query
                ->andWhere('a.niv = :niv')
                ->setParameter('niv', "{$search->niv}");
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
        // if (!empty($search->tssctgice)) {
        //     $query = $query
        //         ->andWhere('g.dsg = :tssctgice')
        //         ->setParameter('tssctgice', "{$search->tsctgice}");
        // }

        $query = $query
            ->orderBy('a.dsg')
            ->setMaxResults(1000);

        if ($search->tctgice or $search->niv or $search->ctgiceDsg or $search->datIns) {
            return $query->getQuery()->getResult();
        } else {
            return $this->findBy(['id' => '-1'], []);
        }
    }

    // /**
    //  * @return Tctgiceniv[] Returns an array of Tctgiceniv objects
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
    public function findOneBySomeField($value): ?Tctgiceniv
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
