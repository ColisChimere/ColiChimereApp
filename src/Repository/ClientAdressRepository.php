<?php

namespace App\Repository;

use App\Entity\ClientAdress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClientAdress>
 *
 * @method ClientAdress|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientAdress|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientAdress[]    findAll()
 * @method ClientAdress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientAdressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientAdress::class);
    }

//    /**
//     * @return ClientAdress[] Returns an array of ClientAdress objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ClientAdress
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
