<?php

namespace App\Repository;

use App\Entity\Organe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Organe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Organe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Organe[]    findAll()
 * @method Organe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Organe::class);
    }

    // /**
    //  * @return Organe[] Returns an array of Organe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Organe
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
