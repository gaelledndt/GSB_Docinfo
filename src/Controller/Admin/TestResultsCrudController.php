<?php

namespace App\Controller\Admin;

use App\Entity\TestResults;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TestResultsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TestResults::class;
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
