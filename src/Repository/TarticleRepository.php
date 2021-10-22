<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Tarticle;
use App\SpecClass\Reponse;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tarticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarticle[]    findAll()
 * @method Tarticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tarticle::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tarticle[]
     */
    public function findSearch(SearchData $search, int $maxResult, Reponse $reponse): array
    {
        $query = $this
            ->createQueryBuilder('a')
            ->leftjoin('a.clrCtgice', 'c')
            ->leftjoin('c.clrNiv1', 'd')
            ->leftjoin('c.clrNiv2', 'e')
            ->leftjoin('c.clrNiv3', 'g')
            ->join('a.clrMrqice', 'f')
            ->join('a.usrIns', 'h')
            ->join('h.clrSrv', 'i');
        // return $this->findAll();
        //dd($query);
        if (!empty($search->codArt)) {
            $query = $query
                ->andWhere('a.cod like :codArt')
                ->setParameter('codArt', "%{$search->codArt}%");
        }
        if (!empty($search->refCtr)) {
            // dd($search->refCtr);
            $query = $query
                ->andWhere('a.refCtr like :refCtr')
                ->setParameter('refCtr', "%{$search->refCtr}%");
        }
        if (!empty($search->lib)) {
            $query = $query
                ->andWhere('a.libCrtFr  like :lib')
                ->setParameter('lib', "%{$search->lib}%");
        }
        if (!empty($search->tctgice)) {
            $query = $query
                ->andWhere('d.id = :tctgice')
                ->setParameter('tctgice', "{$search->tctgice->getId()}");
            // dump($search->tctgice);
        }

        if (!empty($search->tsctgice)) {
            $query = $query
                ->andWhere('e.id = :tsctgice')
                ->setParameter('tsctgice', "{$search->tsctgice->getId()}");
        }

        if (!empty($search->tmrqice)) {
            $query = $query
                ->andWhere('f.nom like :tmrqice')
                ->setParameter('tmrqice', "%{$search->tmrqice}%");
        }

        include "shared/_searchDatCreat.php";
        include "shared/_searchXAct.php";

        $query = $query
            ->orderBy('a.cod')
            ->setMaxResults($maxResult);;

        if ($search->codArt or $search->refCtr or $search->lib or $search->tctgice or $search->tsctgice or $search->tmrqice  or $search->usrInsEmail or $search->srvDsg or ($search->xAct >= '0')) {
            $reponse->setVar01('OK');
            // dd($query->getQuery()->getResult());
            return $query->getQuery()->getResult();
        } else {
            $reponse->setVar01('KO');

            return $this->findBy(['id' => '-1'], []);
        }
    }
    // /**
    //  * récupère les articles du catalogue avec lien avec grille tarifaire
    //  * @return Tarticle[]
    //  */
    // public function findSearchCtl(SearchData $search, int $maxResult, Reponse $reponse, int $idGta): array
    // {
    //     $query = $this
    //         ->createQueryBuilder('a')
    //         ->join('a.clrCtgice', 'c')
    //         ->leftjoin('c.clrNiv1', 'd')
    //         ->leftjoin('c.clrNiv2', 'e')
    //         ->leftjoin('c.clrNiv3', 'g')
    //         ->join('a.clrMrqice', 'f');

    //     if ($idGta > 0) {
    //         $query = $query
    //             ->leftjoin('App\Entity\Tgritarpst', 'gritarpst', 'WITH', 'gritarpst.clrArt = a.id')
    //             ->andWhere('gritarpst.clrGta = :id')
    //             ->setParameter('id', "{$idGta}");
    //     }
    //     // return $this->findAll();
    //     //dd($query);
    //     if (!empty($search->codArt)) {
    //         $query = $query
    //             ->andWhere('a.cod like :codArt')
    //             ->setParameter('codArt', "%{$search->codArt}%");
    //     }
    //     if (!empty($search->lib)) {
    //         $query = $query
    //             ->andWhere('a.libCrtFr  like :lib')
    //             ->setParameter('lib', "%{$search->lib}%");
    //     }
    //     if (!empty($search->tctgice)) {
    //         $query = $query
    //             ->andWhere('d.dsg = :tctgice')
    //             ->setParameter('tctgice', "{$search->tctgice}");
    //     }
    //     if (!empty($search->tsctgice)) {
    //         $query = $query
    //             ->andWhere('e.dsg = :tsctgice')
    //             ->setParameter('tsctgice', "{$search->tsctgice}");
    //     }

    //     if (!empty($search->tmrqice)) {
    //         $query = $query
    //             ->andWhere('f.nom like :tmrqice')
    //             ->setParameter('tmrqice', "%{$search->tmrqice}%");
    //     }

    //     include "shared/_searchDatCreat.php";
    //     include "shared/_searchXAct.php";

    //     $query = $query
    //         ->orderBy('a.cod')
    //         ->setMaxResults($maxResult);;

    //     if ($search->codArt or $search->lib or $search->tctgice or $search->tsctgice or $search->tmrqice or $search->datIns or ($search->xAct >= '0')) {
    //         $reponse->setVar01('OK');
    //         return $query->getQuery()->getResult();
    //     } else {
    //         $reponse->setVar01('KO');
    //         return $this->findBy(['id' => '-1'], []);
    //     }
    // }
    /**
     * récupère les articles de la grille tarifaire
     * @return Tarticle[]
     */
    public function findSearchArtGta(SearchData $search, $idGta): array
    {
        $query = $this
            ->createQueryBuilder('a')
            ->join('a.clrCtgice', 'c')
            ->leftjoin('c.clrNiv1', 'd')
            ->leftjoin('c.clrNiv2', 'e')
            ->leftjoin('a.clrMrqice', 'f');


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
        $query = $query
            ->orderBy('a.cod')
            ->setMaxResults(1000);

        $query = $query
            ->leftjoin('a.tgritarpst', 'gtapst')
            ->addSelect('gtapst')
            ->andwhere('gtapst.clrArt eq :idgta')
            ->andwhere('gtapst.clrArt eq :idgta')
            ->setParameter('idgta', "%{$idGta}%");


        if ($search->codArt or $search->lib or $search->tctgice or $search->tsctgice or $search->tmrqice or $search->datIns or $search->xAct) {

            return $query->getQuery()->getResult();
        } else {
            return $this->findBy(['id' => '-1'], []);
        }
    }
    // /**
    //  * @return Tarticle[] Returns an array of Tarticle objects
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
    public function findOneBySomeField($value): ?Tarticle
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
