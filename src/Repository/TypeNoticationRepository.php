<?php

namespace App\Repository;

use App\Entity\TypeNotication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeNotication>
 *
 * @method TypeNotication|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeNotication|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeNotication[]    findAll()
 * @method TypeNotication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeNoticationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeNotication::class);
    }

//    /**
//     * @return TypeNotication[] Returns an array of TypeNotication objects
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

//    public function findOneBySomeField($value): ?TypeNotication
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
