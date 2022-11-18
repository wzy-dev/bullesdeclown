<?php

namespace App\Repository;

use App\Entity\DataLeft;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DataLeft|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataLeft|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataLeft[]    findAll()
 * @method DataLeft[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataLeftRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DataLeft::class);
    }

    // /**
    //  * @return DataLeft[] Returns an array of DataLeft objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DataLeft
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
