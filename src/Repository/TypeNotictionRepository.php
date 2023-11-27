<?php

namespace App\Repository;

use App\Entity\TypeNotiction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeNotiction>
 *
 * @method TypeNotiction|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeNotiction|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeNotiction[]    findAll()
 * @method TypeNotiction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeNotictionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeNotiction::class);
    }

//    /**
//     * @return TypeNotiction[] Returns an array of TypeNotiction objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeNotiction
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
