<?php

namespace App\Controller\Admin;

use App\Entity\Process;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProcessCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Process::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            IntegerField::new('time', 'estimation for operation in minutes'),
            AssociationField::new('equipment'),
            CollectionField::new('tools'),
            IntegerField::new('qualification'),
            IntegerField::new('type'),
            IntegerField::new('status'),
        ];
    }
}
