<?php

namespace App\Repository;

use DateTime;
use DateInterval;
use App\Entity\Tartmdl;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method TartMdl|null find($id, $lockMode = null, $lockVersion = null)
 * @method TartMdl|null findOneBy(array $criteria, array $orderBy = null)
 * @method TartMdl[]    findAll()
 * @method TartMdl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TartmdlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tartmdl::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tartcpd[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('amdl')
            ->join('amdl.clrArt', 'a')
            ->join('a.clrCtgice', 'c')
            ->join('c.clrNiv1', 'd')
            ->join('c.clrNiv2', 'e')
            ->join('a.clrMrqice', 'f');
        // return $this->findAll();
        //dd($query);
        if (!empty($search->codArt)) {
            $query = $query
                ->andWhere('a.cod like :codArt')
                ->setParameter('codArt', "%{$search->codArt}%");
        }
        if (!empty($search->lib)) {
            $query = $query
                ->andWhere('a.libCrtFr  like :lib')
                ->setParameter('lib', "%{$search->lib}%");
        }
        if (!empty($search->tctgice)) {
            $query = $query
                ->andWhere('d.dsg like :tctgice')
                ->setParameter('tctgice', "%{$search->tctgice}%");
        }
        if (!empty($search->tsctgice)) {
            $query = $query
                ->andWhere('e.dsg like :tsctgice')
                ->setParameter('tsctgice', "%{$search->tsctgice}%");
        }
        if (!empty($search->tmrqice)) {
            $query = $query
                ->andWhere('f.nom like :tmrqice')
                ->setParameter('tmrqice', "%{$search->tmrqice}%");
        }
        if (!empty($search->datIns)) {
     
            $datStr = date_format($search->datIns, 'Y-m-d');
            $datj1 = new DateTime($datStr);
            $datj1->add(new DateInterval('P1D'));
            $datStrj1 = date_format($datj1, 'Y-m-d');;
            $query = $query
                ->andWhere('amdl.datIns >= :dat')
                ->setParameter('dat', "{$datStr}");
            // $query = $query
            //     ->andWhere('a.datIns < :dat')
            //     ->setParameter('dat', "{$datStrj1}");
        }
        $query = $query
            ->orderBy('a.cod')
            ->setMaxResults(1000);

        if ($search->codArt or $search->lib or $search->tctgice or $search->tsctgice or $search->tmrqice or $search->datIns) {
            return $query->getQuery()->getResult();
        } else {
            return $this->findBy(['id' => '-1'], []);
        }
    }

    // /**
    //  * @return Tartmdlimp[] Returns an array of Tartmdlimp objects
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
    public function findOneBySomeField($value): ?Tartmdlimp
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
