<?php

namespace App\Repository;

use App\Entity\Bioagresseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bioagresseur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bioagresseur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bioagresseur[]    findAll()
 * @method Bioagresseur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BioagresseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bioagresseur::class);
    }

    // /**
    //  * @return Bioagresseur[] Returns an array of Bioagresseur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bioagresseur
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
