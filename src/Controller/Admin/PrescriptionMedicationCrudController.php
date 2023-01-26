<?php

namespace App\Controller\Admin;

use App\Entity\PrescriptionMedication;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PrescriptionMedicationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PrescriptionMedication::class;
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
