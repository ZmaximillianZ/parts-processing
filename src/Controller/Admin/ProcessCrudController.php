<?php

namespace App\Controller\Admin;

use App\Entity\Process;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class ProcessCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Process::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TimeField::new('time'),
            IntegerField::new('qualification'),
            IntegerField::new('type'),
            IntegerField::new('status'),
        ];
    }
}
