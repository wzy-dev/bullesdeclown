<?php

namespace App\Repository;

use App\Entity\Schedulde;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Schedulde|null find($id, $lockMode = null, $lockVersion = null)
 * @method Schedulde|null findOneBy(array $criteria, array $orderBy = null)
 * @method Schedulde[]    findAll()
 * @method Schedulde[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScheduldeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Schedulde::class);
    }

    // /**
    //  * @return Schedulde[] Returns an array of Schedulde objects
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
    public function findOneBySomeField($value): ?Schedulde
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
