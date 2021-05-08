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
            yield TextField::new('position');
            yield AssociationField::new('user');
            yield IntegerField::new('qualification');
            yield BooleanField::new('isQualification');
//            yield AssociationField::new('workerEquipments');
            yield AssociationField::new('brigade');
            yield IntegerField::new('status');
    }
}
