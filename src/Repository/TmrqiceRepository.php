<?php

namespace App\Repository;

use App\Entity\Tmrqice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tmrqice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tmrqice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tmrqice[]    findAll()
 * @method Tmrqice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TmrqiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tmrqice::class);
    }

    /**
     * @return Tmrqice Returns an array of Tmrqice objects
     */

    public function findByNom($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('UPPER(a.nom) = :val')
            ->setParameter('val', $value)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Tmrqice
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
