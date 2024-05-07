<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Relai;
use App\Form\CommandeFormType;
use App\Repository\RelaiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{

    #[Route('/commande', name: 'app_commande')]
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
    #[Route('/commande/create', name: 'app_createcommande')]
    public function createCommande(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commande = new Commande();
        $form = $this->createForm(CommandeFormType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commande = $form->getData();
            $relai = $entityManager->getRepository(Relai::class)->find(1);
            $commande->setRelaiDepart($relai);
            $entityManager->persist($commande);
            try {
                $entityManager->flush();

                return $this->redirectToRoute('app_commandecreate');
            } catch (\Throwable $th) {
                $m = $th->getMessage();
            }
        }

        return $this->render('commande/createCommande.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
