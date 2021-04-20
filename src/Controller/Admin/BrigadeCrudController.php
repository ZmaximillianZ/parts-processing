<?php

namespace App\Controller\Admin;

use App\Entity\Brigade;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BrigadeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Brigade::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('workShift'),
            IntegerField::new('type'),
            IntegerField::new('status'),
        ];
    }
}
