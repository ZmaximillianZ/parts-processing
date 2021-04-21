<?php

namespace App\Controller\Admin;

use App\Entity\Worker;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class WorkerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Worker::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('position'),
            AssociationField::new('user'),
            IntegerField::new('qualification'),
            BooleanField::new('isQualification'),
            CollectionField::new('workerEquipments'),
            AssociationField::new('brigade'),
            IntegerField::new('status'),
        ];
    }
}
