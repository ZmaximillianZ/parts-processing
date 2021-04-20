<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class UserController extends AbstractDashboardController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
}
