<?php

namespace App\Repository;

use App\Entity\ScheduldeField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ScheduldeField|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScheduldeField|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScheduldeField[]    findAll()
 * @method ScheduldeField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScheduldeFieldRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ScheduldeField::class);
    }

    // /**
    //  * @return ScheduldeField[] Returns an array of ScheduldeField objects
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
    public function findOneBySomeField($value): ?ScheduldeField
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
