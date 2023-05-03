<?php

namespace App\Controller\Admin;

use App\Entity\TestResults;
use App\Entity\TestResultType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TestResultsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TestResults::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Les résultats de test');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('result')
            ->setLabel('Résultat'),
            TextEditorField::new('description')
            ->setLabel('Description du test'),
            TextEditorField::new('comment')
                ->setLabel('Commentaire'),
            AssociationField::new('care_summary')
                ->setLabel('Patient'),
            AssociationField::new('test_result_type')
            ->setLabel('Type de test'),
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof TestResults) return;

        $entityInstance->setUpdatedAt(new \DateTimeImmutable());

        parent::updateEntity($entityManager, $entityInstance);
    }


}
