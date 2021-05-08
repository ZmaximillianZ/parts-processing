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
use App\Entity\WorkerEquipment;
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
        yield MenuItem::linkToCrud('User', 'fa fa-user-o', User::class);
        yield MenuItem::linkToCrud('Worker', 'far fa-handshake', Worker::class);
        yield MenuItem::linkToCrud('WorkerEquipment', 'far fa-life-ring', WorkerEquipment::class);
        yield MenuItem::linkToCrud('Equipment', 'fas fa-cog', Equipment::class);
        yield MenuItem::linkToCrud('Brigade', 'fa fa-users', Brigade::class);
        yield MenuItem::linkToCrud('Detail', 'fa fa-diamond', Detail::class);
        yield MenuItem::linkToCrud('Process', 'fa fa-chain', Process::class);
        yield MenuItem::linkToCrud('TechnologicalMap', 'fa fa-map-o', TechnologicalMap::class);
        yield MenuItem::linkToCrud('Tool', 'fab fa-scribd', Tool::class);
    }
}