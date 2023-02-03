<?php

namespace App\Controller\Admin;

use App\Entity\Extra;
use App\Entity\Pictures;
use App\Entity\Reservation;
use App\Entity\Room;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\ExtraCrudController;

class DashboardController extends AbstractDashboardController
{

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {


        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('PerfectParty');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Blog');

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Extras');

        yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Create Extra', 'fas fa-plus-circle', Extra::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Extra', 'fas fa-eye', Extra::class),
        ]);

        yield MenuItem::section('Room');

        yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Create Room', 'fas fa-plus-circle', Room::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Room', 'fas fa-eye', Room::class),
            MenuItem::linkToCrud('Add Picture', 'fas fa-image', Pictures::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::section('Reservation');

        yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Show Reservation', 'fas fa-eye', Reservation::class),
        ]);
    }
}
