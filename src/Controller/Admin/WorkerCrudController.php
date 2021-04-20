<?php

namespace App\Controller\Admin;

use App\Entity\Worker;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
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
            IntegerField::new('qualification'),
            BooleanField::new('isQualification'),
            IntegerField::new('status'),
        ];
    }

}
