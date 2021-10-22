<?php

namespace App\Repository;

use App\Entity\Tarttrfsitweb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tarttrfsitweb|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarttrfsitweb|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarttrfsitweb[]    findAll()
 * @method Tarttrfsitweb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarttrfsitwebRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tarttrfsitweb::class);
    }

    // /**
    //  * @return Tarttrfsitweb[] Returns an array of Tarttrfsitweb objects
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
    public function findOneBySomeField($value): ?Tarttrfsitweb
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
