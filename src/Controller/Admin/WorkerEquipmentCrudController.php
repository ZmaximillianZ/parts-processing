<?php

namespace App\Controller\Admin;

use App\Entity\WorkerEquipment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class WorkerEquipmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WorkerEquipment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('qualification'),
            AssociationField::new('worker'),
            AssociationField::new('equipment'),
        ];
    }
}
