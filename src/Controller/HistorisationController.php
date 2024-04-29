<?php

namespace App\Controller;

use App\Entity\Historisation;
use App\Repository\UserRepository;
use App\Repository\HistorisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistorisationController extends AbstractController
{
    #[Route('/historisation', name: 'app_historisation')]
    public function index( HistorisationRepository $historisationRepository , UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->count([]);
        $historisation = new Historisation();
        $historisation->setNbrUser($user);
        $historisation->setDateHistorisation(new \DateTime());
        $entityManager->persist($historisation);
        $entityManager->flush();
        $historique = $historisationRepository->findAll();
        return $this->render('historisation/index.html.twig', [
            'historique' => $historique,
        ]);
    }
}
