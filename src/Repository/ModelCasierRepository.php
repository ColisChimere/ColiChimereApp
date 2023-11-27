<?php

namespace App\Repository;

use App\Entity\ModelCasier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModelCasier>
 *
 * @method ModelCasier|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelCasier|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelCasier[]    findAll()
 * @method ModelCasier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelCasierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModelCasier::class);
    }

//    /**
//     * @return ModelCasier[] Returns an array of ModelCasier objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ModelCasier
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
