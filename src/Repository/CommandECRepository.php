<?php

namespace App\Repository;

use App\Entity\CommandEC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommandEC>
 *
 * @method CommandEC|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandEC|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandEC[]    findAll()
 * @method CommandEC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandECRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandEC::class);
    }

//    /**
//     * @return CommandEC[] Returns an array of CommandEC objects
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

//    public function findOneBySomeField($value): ?CommandEC
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
