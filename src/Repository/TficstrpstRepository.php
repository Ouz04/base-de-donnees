<?php

namespace App\Repository;

use App\Entity\Tficstrpst;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tficstrpst|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tficstrpst|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tficstrpst[]    findAll()
 * @method Tficstrpst[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TficstrpstRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tficstrpst::class);
    }

    // /**
    //  * @return Tficstrpst[] Returns an array of Tficstrpst objects
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
    public function findOneBySomeField($value): ?Tficstrpst
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
