<?php

namespace App\Repository;

use App\Entity\APISecurityController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<APISecurityController>
 *
 * @method APISecurityController|null find($id, $lockMode = null, $lockVersion = null)
 * @method APISecurityController|null findOneBy(array $criteria, array $orderBy = null)
 * @method APISecurityController[]    findAll()
 * @method APISecurityController[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class APISecurityControllerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, APISecurityController::class);
    }

//    /**
//     * @return APISecurityController[] Returns an array of APISecurityController objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?APISecurityController
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
