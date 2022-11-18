<?php

namespace App\Repository;

use App\Entity\DataRight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DataRight|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataRight|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataRight[]    findAll()
 * @method DataRight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataRightRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DataRight::class);
    }

    // /**
    //  * @return DataRight[] Returns an array of DataRight objects
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
    public function findOneBySomeField($value): ?DataRight
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
