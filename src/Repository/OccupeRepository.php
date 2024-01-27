<?php

namespace App\Repository;

use App\Entity\Occupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Occupe>
 *
 * @method Occupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Occupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Occupe[]    findAll()
 * @method Occupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OccupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Occupe::class);
    }

//    /**
//     * @return Occupe[] Returns an array of Occupe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Occupe
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
