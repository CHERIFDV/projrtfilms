<?php

namespace App\Controller\Admin;

use App\Entity\Pay;
use App\Entity\Role;
use App\Entity\Acteur;
use App\Entity\Ouevre;
use App\Entity\Episode;
use App\Entity\Categorie;
use App\Entity\Abonnement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Syprfilme');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Abonnement', 'fas fa-Abonnement', Abonnement::class);
        yield MenuItem::linkToCrud('Episode', 'fas fa-Episode', Episode::class);
        yield MenuItem::linkToCrud('Acteur', 'fas fa-Acteur', Acteur::class);
        yield MenuItem::linkToCrud('Categorie', 'fas fa-Categorie', Categorie::class);
        yield MenuItem::linkToCrud('Ouevre', 'fas fa-Ouevre', Ouevre::class);
        yield MenuItem::linkToCrud('Pay', 'fas fa-Pay', Pay::class);
        yield MenuItem::linkToCrud('Role', 'fas fa-Role', Role::class);

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
