<?php

namespace App\Repository;

use App\Entity\Tartcot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tartcot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tartcot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tartcot[]    findAll()
 * @method Tartcot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TartcotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tartcot::class);
    }

    /**
     * récupère les produits en lien avec une recherche
     * @return Tartcot[]
     */
    public function findSearchGta($idGta, $date)
    {
        $datStr1 = date_format($date, 'Y-m-d');

        $query = $this->createQueryBuilder('a')
            ->join('App\Entity\Tgritarpst', 'gta', 'WITH', 'gta.clrArt = a.clrArt')
            ->leftjoin('App\Entity\Tcotation', 'cot', 'WITH', 'cot.id = a.clrCot')
            ->andWhere('gta.clrGta = :idGta')
            ->andWhere('cot.datDeb >= :datStr1 ')
            ->andWhere('cot.datFin >= :datStr1')
            ->andWhere('cot.xAct = true')
            ->setParameter('datStr1', "{$datStr1}")
            ->setParameter('idGta', "{$idGta}");



        return $query->getQuery()->getResult();
    }
    // /**
    //  * @return Tartcot[] Returns an array of Tartcot objects
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
    public function findOneBySomeField($value): ?Tartcot
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
