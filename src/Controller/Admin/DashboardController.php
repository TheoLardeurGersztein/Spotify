<?php

namespace App\Controller\Admin;

use App\Entity\Music;
use App\Entity\Artist;
use App\Entity\Membre;
use App\Entity\SharedPlaylist;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(PlaylistCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Page');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Music', 'fa fa-music', Music::class);
        yield MenuItem::linkToCrud('Artist', 'fa fa-user', Artist::class);
        yield MenuItem::linkToCrud('Membre', 'fa fa-poo', Membre::class);
        yield MenuItem::linkToCrud('SharedPlaylist', 'fa fa-folder-open', SharedPlaylist::class);
    }
}
