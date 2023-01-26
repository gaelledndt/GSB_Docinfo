<?php

namespace App\Controller\Admin;

use App\Entity\TestResultType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TestResultTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TestResultType::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
