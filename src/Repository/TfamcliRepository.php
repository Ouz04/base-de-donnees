<?php

namespace App\Repository;

use App\Entity\Tfamcli;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tfamcli|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tfamcli|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tfamcli[]    findAll()
 * @method Tfamcli[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TfamcliRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tfamcli::class);
    }

    // /**
    //  * @return Tfamcli[] Returns an array of Tfamcli objects
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
    public function findOneBySomeField($value): ?Tfamcli
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
