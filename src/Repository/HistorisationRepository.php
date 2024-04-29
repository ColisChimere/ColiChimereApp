<?php

namespace App\Repository;

use App\Entity\Historisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Historisation>
 *
 * @method Historisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Historisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Historisation[]    findAll()
 * @method Historisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistorisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Historisation::class);
    }
    public function compterUtilisateursEtHistoriser(UserRepository $userRepository)
    {
        // Compter les utilisateurs
        $nombreUtilisateurs = $userRepository->count([]);

        // Créer une nouvelle instance de l'entité Historisation
        $historisation = new Historisation();
        $historisation->setNbrUser($nombreUtilisateurs);
        $historisation->setDateHistorisation(new \DateTime());

        // Enregistrer l'entité Historisation dans la base de données
        $this->_em->persist($historisation);
        $this->_em->flush();
    }



//    /**
//     * @return Historisation[] Returns an array of Historisation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Historisation
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
