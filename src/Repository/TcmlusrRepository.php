<?php

namespace App\Repository;

use App\Entity\Tcmlusr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tcmlusr|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tcmlusr|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tcmlusr[]    findAll()
 * @method Tcmlusr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TcmlusrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tcmlusr::class);
    }

    // /**
    //  * @return Tcmlusr[] Returns an array of Tcmlusr objects
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
    public function findOneBySomeField($value): ?Tcmlusr
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
