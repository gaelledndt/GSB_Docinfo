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
            ->setTitle('GSB - Application Médicale')
            ->setLocales(['en', 'fr']);
    }

    public function configureMenuItems(): iterable
    {
       // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home', CareSummary::class);

        yield MenuItem::linkToUrl('Retour à l\' app', 'fa fa-return', '/');

        /*              Compte               */
        yield MenuItem::section('Comptes', 'fa fa-solid fa-id-card-clip');
        /*              ROLES               */
        yield MenuItem::subMenu('Roles', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des roles', 'fa fa-list', Role::class),
        ]);
        /*              ROLES               */
        yield MenuItem::subMenu('Genre', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des genres', 'fa fa-list', Gender::class),
        ]);
        /*              USERS               */
        yield MenuItem::subMenu('Utilisateurs', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des utilisateurs', 'fa fa-list', User::class),
        ]);
        /*              CareSummary               */
        yield MenuItem::section('Informations médicales', 'fa fa-solid fa-passport');
        yield MenuItem::subMenu('Dossiers médicales', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des fiches de renseignements', 'fa fa-list', CareSummary::class),
        ]);
        /*              Health Status  & Status             */
        yield MenuItem::subMenu('États de santé', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud("Liste des états de santé", 'fa fa-list', HealthStatus::class),
        ]);
        yield MenuItem::subMenu('Gestion des status', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des status', 'fa fa-list', Status::class),
        ]);
        /*              Allergenic               */
        yield MenuItem::section('Les Allergies', 'fa fa-solid fa-bacterium');
        yield MenuItem::subMenu('Gestion des allergies', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des fiches de allergies', 'fa fa-list', Allergenic::class),
        ]);
        /*              Presciption   &  Prescription Medication                 */
        yield MenuItem::section('Prescriptions', 'fa fa-solid fa-receipt');
        yield MenuItem::subMenu('Gestion des prescriptions', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des prescriptions', 'fa fa-list', Prescription::class),
            MenuItem::linkToCrud('Liste des prescritpions médicales', 'fa fa-list', PrescriptionMedication::class),

        ]);
        /*              Test Result     &  Test Result Type                 */
        yield MenuItem::section('Tests', ' fa fa-solid fa-book-medical');
        yield MenuItem::subMenu('Résultats des tests', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des résultats de test', 'fa fa-list', TestResults::class),
        ]);
        yield MenuItem::subMenu('Types de tests', 'fa-solid fa-right-long')->setSubItems([
            MenuItem::linkToCrud('Liste des types de test', 'fa fa-list', TestResultType::class),
        ]);
    }
}
