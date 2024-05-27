<?php

namespace App\Controller;

use App\Entity\Relai;
use App\Form\RelaiType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RelaiController extends AbstractController
{
    #[Route('/relai', name: 'app_relai')]
    public function index(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $message = null;
        $relai = new Relai();
        $form = $this->createForm(RelaiType::class, $relai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManagerInterface->persist($relai);
            $entityManagerInterface->flush();
            $form = $this->createForm(RelaiType::class, $relai);
            $message = 'Succes ajout '.$relai->getNomRelai();
        }
        return $this->render('relai/index.html.twig', [
            'form' => $form,
            'message' => ''
        ]);
    }
}
