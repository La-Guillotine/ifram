<?php

namespace App\Repository;

use App\Entity\Ravageur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ravageur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ravageur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ravageur[]    findAll()
 * @method Ravageur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RavageurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ravageur::class);
    }

    // /**
    //  * @return Ravageur[] Returns an array of Ravageur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ravageur
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
