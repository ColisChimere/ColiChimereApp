<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiSecurityController extends AbstractController
{
    #[Route('/api/security', name: 'app_api_security')]
    public function index(): Response
    {
        return $this->render('api_security/index.html.twig', [
            'controller_name' => 'ApiSecurityController',
        ]);
    }
}
