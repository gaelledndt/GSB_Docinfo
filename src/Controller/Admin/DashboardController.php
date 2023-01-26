<?php

namespace App\Controller\Admin;

use App\Entity\CareSummary;
use App\Entity\Role;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private AdminUrlGenerator $adminUrlGenerator;
    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        return $this->redirect($this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        // return $this->render('my-dashboard.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gsb - Application Médicale')
            ->setLocales(['en', 'fr']);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToUrl('Retour à l\' app', 'fa fa-return', '/');

        /*              ROLES               */
        yield MenuItem::section('Gestion des roles', 'fa-brands fa-critical-role');
        yield MenuItem::subMenu('Roles', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des roles', 'fa fa-list', Role::class),
        ]);
        /*              USERS               */
        yield MenuItem::section('Gestion des utilisateurs', 'fa-solid fa-users');
        yield MenuItem::subMenu('Utilisateurs', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des utilisateurs', 'fa fa-list', User::class),
        ]);
        /*              CareSummary               */
        yield MenuItem::section('Gestion des fiches de renseignement', 'fa fa-child');
        yield MenuItem::subMenu('Fiches de renseignements', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des fiches de renseignements', 'fa fa-list', CareSummary::class),
        ]);
    }
}
