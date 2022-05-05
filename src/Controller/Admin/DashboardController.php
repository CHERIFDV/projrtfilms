<?php

namespace App\Controller\Admin;

use App\Entity\Pay;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Acteur;
use App\Entity\Ouevre;
use App\Entity\Episode;
use App\Entity\Categorie;
use App\Entity\Abonnement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //return parent::index();
        return $this->render('admin/admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Syprfilme');
    }

    public function configureMenuItems(): iterable
    
    {
        yield MenuItem::linkToUrl('Dashboard', 'fa fa-home','/admin');
        yield MenuItem::linkToCrud('Abonnement', 'fa fa-award', Abonnement::class);
        yield MenuItem::linkToCrud('Episode', 'fa fa-film', Episode::class);
        yield MenuItem::linkToCrud('Acteur', 'fa fa-eye', Acteur::class);
        yield MenuItem::linkToCrud('Categorie', 'fa fa-cubes', Categorie::class);
        yield MenuItem::linkToCrud('Ouevre', 'fa fa-desktop', Ouevre::class);
        yield MenuItem::linkToCrud('Pay', 'fa fa-flag', Pay::class);
        yield MenuItem::linkToCrud('Role', 'fa fa-blind', Role::class);
        yield MenuItem::linkToCrud('User', 'fa fa-blind', User::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
