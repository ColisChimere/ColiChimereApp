<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use App\Entity\User;
use App\Entity\EtatCommande;
use App\Entity\Relai;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{   
    public function __construct (private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
       
        $Url = $this->adminUrlGenerator
        ->setController(RelaiCrudController::class)
        ->generateUrl();
        
        return $this->redirect($Url);
        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ApColiAPI');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Relai', 'fas fa-list', Relai::class);
        yield MenuItem::linkToCrud('Etat Commande', 'fas fa-list', EtatCommande::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Commande', 'fas fa-list', Commande::class);
    }
}
