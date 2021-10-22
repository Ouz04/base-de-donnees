<?php

namespace App\Repository;

use App\Entity\Tartfou;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Tartfou|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tartfou|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tartfou[]    findAll()
 * @method Tartfou[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TartfouRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tartfou::class);
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tartfou[]
     */
    public function findSearch(SearchData $search, $maxResult, $reponse): array
    {
        $query = $this
            ->createQueryBuilder('a')
            ->join('a.clrArt', 't')
            ->leftJoin('t.clrCtgice', 'c')
            ->leftJoin('c.clrNiv1', 'd')
            ->leftJoin('c.clrNiv2', 'e')
            ->leftJoin('t.clrMrqice', 'f')
            ->join('a.clrFou', 'g');
        // return $this->findAll();
        //dd($query);
        include "shared/_searchArt01.php";
        include "shared/_searchDatCreat.php";
        include "shared/_searchXAct.php";

        $query = $query
            ->orderBy('t.cod')
            ->setMaxResults($maxResult);

        if ($search->codArt or $search->lib or $search->tctgice or $search->tsctgice or $search->tmrqice or $search->tfournisseur) {
            $reponse->setVar01('OK');
            return $query->getQuery()->getResult();
        } else {
            $reponse->setVar01('KO');
            return $this->findBy(['id' => '-1'], []);
        }
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tartfou[]
     */
    public function findSearchTest($maxResult): array
    {
        $query = $this
            ->createQueryBuilder('a');


        $query = $query
            ->setMaxResults($maxResult);

        return $query->getQuery()->getResult();
    }
    public function getCustomInformations()
    {
        $rawSql = "SELECT m.id, (SELECT COUNT(i.id) FROM item AS i WHERE i.myclass_id = m.id) AS total FROM myclass AS m";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();
    }
    /**
     * récupère les produits en lien avec une recherche
     * @return Tartfou[]
     */
    public function findSearchGta(SearchData $search, $idGta): array
    {
        
        $query = $this
            ->createQueryBuilder('a')
            ->join('App\Entity\Tgritarpst', 'gta', 'WITH', 'gta.clrArt = a.clrArt')
            ->join('a.clrArt', 't')
            ->join('a.clrFou', 'g')
            ->leftJoin('t.clrCtgice', 'c')
            ->leftJoin('c.clrNiv1', 'd')
            ->leftJoin('c.clrNiv2', 'e')
            ->leftJoin('t.clrMrqice', 'f')
            ->leftjoin('App\Entity\Tcotation', 'cot', 'WITH', 'cot.id = a.clrCot')
            ->andWhere('gta.clrGta = :idGta')
            ->andWhere('a.xAct = true')
            // ->andWhere('cot.datDeb <= :datStr1 ')
            // ->andWhere('cot.datFin >= :datStr1')
            ->setParameter('idGta', "{$idGta}");
            // ->setParameter('datStr1', "{$datStr1}");

        include "shared/_searchArt01.php";
        // dump($query->getQuery());
        return $query->getQuery()->getResult();
    }
    /**
     * 
     */
    public function getNb()
    {

        return $this->createQueryBuilder('l')

            ->select('COUNT(l)')

            ->getQuery()

            ->getSingleScalarResult();
    }
    // /**
    //  * récupère l'article fournisseur en cours
    //  * @return Tartfou[]
    //  */
    // public function getArtfouActif(int $fouId, int $artId, int $qteCnd): array
    // {
    // }
    // /**
    //  * @return Tartfou[] Returns an array of Tartfou objects
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
    public function findOneBySomeField($value): ?Tartfou
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
