<?php

namespace App\Controller\Admin;

use App\Entity\Adresse;
use App\Entity\Commande;
use App\Entity\User;
use App\Entity\EtatCommande;
use App\Entity\Relai;
use App\Form\RegistrationFormType;
use Doctrine\ORM\Mapping\EntityListenerResolver;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
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
        yield MenuItem::subMenu('Relai', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('CreateRelai', 'fas fa-plus', Relai::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('ShowRelai', 'fas fa-eye', Relai::class)
        ]);
        yield MenuItem::subMenu('User', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('CreateUser', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('ShowUser', 'fas fa-eye', User::class)
        ]);
        yield MenuItem::subMenu('Adresses', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('CreateAdresse', 'fas fa-plus', Adresse::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('ShowAdresse', 'fas fa-eye', Adresse::class)
        ]);
    }
    
}
