<?php

namespace App\Controller\Admin;

use App\Entity\WorkerEquipmentDetailProcess;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class WorkerEquipmentDetailProcessController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WorkerEquipmentDetailProcess::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('workerEquipment'),
            AssociationField::new('detail'),
            IntegerField::new('time', 'estimation for operation in minutes'),
            DateTimeField::new('createdAt'),
        ];
    }
}