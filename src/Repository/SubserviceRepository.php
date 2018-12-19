<?php

namespace App\Repository;

use App\Entity\Subservice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Subservice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subservice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subservice[]    findAll()
 * @method Subservice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubserviceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subservice::class);
    }

    // /**
    //  * @return Subservice[] Returns an array of Subservice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subservice
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
