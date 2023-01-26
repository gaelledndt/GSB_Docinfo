<?php

namespace App\Controller\Admin;

use App\Entity\HealthStatus;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HealthStatusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HealthStatus::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('disease')
            ->setLabel('Maladie'),
            TextEditorField::new('description')
            ->setLabel('Description ou/et commentaire'),
            AssociationField::new('status')
            ->setLabel('Statut de la maladie'),
            AssociationField::new('care_summary')
            ->setLabel('Patient'),
            ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof HealthStatus) return;

        $entityInstance->setUpdatedAt(new \DateTimeImmutable());

        parent::updateEntity($entityManager, $entityInstance);
    }
}
