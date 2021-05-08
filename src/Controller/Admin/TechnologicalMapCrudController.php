<?php

namespace App\Controller\Admin;

use App\Entity\TechnologicalMap;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TechnologicalMapCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TechnologicalMap::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            IntegerField::new('x'),
            IntegerField::new('y'),
            IntegerField::new('z'),
            IntegerField::new('weight'),
            TextField::new('materialGrade'),
            IntegerField::new('tolerance'),
            CollectionField::new('processes'),
        ];
    }
}
