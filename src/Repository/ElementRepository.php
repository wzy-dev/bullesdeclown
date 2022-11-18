<?php

namespace App\Repository;

use App\Entity\Element;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Element|null find($id, $lockMode = null, $lockVersion = null)
 * @method Element|null findOneBy(array $criteria, array $orderBy = null)
 * @method Element[]    findAll()
 * @method Element[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Element::class);
    }

    // /**
    //  * @return Element[] Returns an array of Element objects
    //  */
    
    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('e')
    //         ->andWhere('e.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('e.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    

    
    public function findOneByRank($category,$start): ?Element
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.category = :cat')
            ->setParameter('cat', $category)
            ->andWhere('e.type != :undefined')
            ->setParameter('undefined', 'undefined')
            ->orderBy('e.rank', 'ASC')
            ->setFirstResult($start)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findListByRank($category,$start,$end)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.category = :cat')
            ->setParameter('cat', $category)

            ->andWhere('e.type != :undefined')
            ->setParameter('undefined', 'undefined')

            ->andWhere('e.rank >= :start')
            ->setParameter('start', $start)

            ->andWhere('e.rank <= :end')
            ->setParameter('end', $end)

            ->orderBy('e.rank', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }    
}
