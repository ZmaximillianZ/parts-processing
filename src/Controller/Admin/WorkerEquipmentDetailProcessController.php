<?php

namespace App\Controller\Admin;

use App\Entity\WorkerEquipmentDetailProcess;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class WorkerEquipmentDetailProcessController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WorkerEquipmentDetailProcess::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('worker'),
            AssociationField::new('detail'),
            IntegerField::new('time', 'estimation for operation in minutes'),
            TextField::new('equipment'),
        ];
    }
}