<?php

namespace App\Controller\Admin;


use App\Entity\Brigade;
use App\Entity\Detail;
use App\Entity\Equipment;
use App\Entity\Process;
use App\Entity\TechnologicalMap;
use App\Entity\Tool;
use App\Entity\User;
use App\Entity\Worker;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Important!!');
        yield MenuItem::linkToCrud('User', 'fa fa-file-word', User::class);
        yield MenuItem::linkToCrud('Worker', 'fa fa-file-word', Worker::class);
        yield MenuItem::linkToCrud('Brigade', 'fa fa-file-word', Brigade::class);
        yield MenuItem::linkToCrud('Detail', 'fa fa-file-word', Detail::class);
        yield MenuItem::linkToCrud('Equipment', 'fa fa-file-word', Equipment::class);
        yield MenuItem::linkToCrud('Process', 'fa fa-file-word', Process::class);
        yield MenuItem::linkToCrud('TechnologicalMap', 'fa fa-file-word', TechnologicalMap::class);
        yield MenuItem::linkToCrud('Tool', 'fa fa-file-word', Tool::class);
    }
}