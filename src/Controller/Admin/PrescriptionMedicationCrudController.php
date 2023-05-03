<?php

namespace App\Controller\Admin;

use App\Entity\PrescriptionMedication;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PrescriptionMedicationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PrescriptionMedication::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Les prescriptions médicales');
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextEditorField::new('description')
            ->setLabel('Description et/ou commentaire'),
            TextField::new('medication')
            ->setLabel('Médicament prescrit'),
            DateTimeField::new('end_medication')
            ->setLabel('Fin de la prise du médicament'),
            AssociationField::new('prescription')
            ->setLabel('Prescription')
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof PrescriptionMedication) return;

        $entityInstance->setUpdatedAt(new \DateTimeImmutable());

        parent::updateEntity($entityManager, $entityInstance);
    }
}
