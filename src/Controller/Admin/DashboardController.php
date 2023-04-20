<?php

namespace App\Controller\Admin;

use App\Entity\Allergenic;
use App\Entity\CareSummary;
use App\Entity\Gender;
use App\Entity\HealthStatus;
use App\Entity\Prescription;
use App\Entity\PrescriptionMedication;
use App\Entity\Role;
use App\Entity\Status;
use App\Entity\TestResults;
use App\Entity\TestResultType;
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
        if ($this->getUser() === null){
           // dd('$this->getUser() === null');
            return $this->redirect('/login');
        }elseif ($this->getUser()->getRole()->getSlug() === 'medecin' ||
            $this->getUser()->getRole()->getSlug() === 'infirmier'
        )
        {
            return $this->redirect($this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
        }else{
            return $this->redirect('/');
        }
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
        /*              Allergenic               */
        yield MenuItem::section('Gestion des Allergies', 'fa fa-child');
        yield MenuItem::subMenu('Fiches des allergies', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des fiches de allergies', 'fa fa-list', Allergenic::class),
        ]);
        /*              Health Status  & Status             */
        yield MenuItem::section("Gestion de l'état de santé", 'fa fa-child');
        yield MenuItem::subMenu('Fiches des états', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud("Liste des états de santé", 'fa fa-list', HealthStatus::class),
            MenuItem::linkToCrud('Liste des status', 'fa fa-list', Status::class),
        ]);
        /*              Presciption   &  Prescription Medication                 */
        yield MenuItem::section('Gestion des Prescription', 'fa fa-child');
        yield MenuItem::subMenu('Fiches des prescriptions', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des prescriptions', 'fa fa-list', Prescription::class),
            MenuItem::linkToCrud('Liste des prescritpions médicales', 'fa fa-list', PrescriptionMedication::class),

        ]);
        /*              Gender               */
        yield MenuItem::section('Gestion des Genre', 'fa fa-child');
        yield MenuItem::subMenu('Fiches des genre', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des genre', 'fa fa-list', Gender::class),
        ]);
        /*              Test Result     &  Test Result Type                 */
        yield MenuItem::section('Gestion des résultats de test', 'fa fa-child');
        yield MenuItem::subMenu('Fiches des résultats de test', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des résultats de test', 'fa fa-list', TestResults::class),
            MenuItem::linkToCrud('Liste des types de test', 'fa fa-list', TestResultType::class),

        ]);

    }
}
