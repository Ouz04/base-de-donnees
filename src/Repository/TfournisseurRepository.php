<?php

namespace App\Repository;

use App\Entity\Tfournisseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tfournisseur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tfournisseur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tfournisseur[]    findAll()
 * @method Tfournisseur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TfournisseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tfournisseur::class);
    }

    // /**
    //  * @return Tfournisseur[] Returns an array of Tfournisseur objects
    //  */

    // public function findOneByRso($value)
    // {
    //     return $this->createQueryBuilder('t')
    //         ->andWhere('t.rso = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult();
    // }


    /*
    public function findOneBySomeField($value): ?Tfournisseur
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
