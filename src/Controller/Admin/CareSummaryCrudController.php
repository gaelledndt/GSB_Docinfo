<?php

namespace App\Controller\Admin;

use App\Entity\CareSummary;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CareSummaryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CareSummary::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstname')
            ->setLabel('Prénom'),
            TextField::new('lastname')
                ->setLabel('Nom'),
            IntegerField::new('number_ss')
                ->setLabel('Numéro de sécurité sociale'),
            DateTimeField::new('birthday')
                ->setLabel('Date de naissance'),
            TextField::new('description')
                ->setLabel('Description générale'),
            AssociationField::new('User')
                ->setLabel('A quel utilisateur ?'),
            AssociationField::new('doctor_referring')
                ->setLabel('Le médecin référent'),
            AssociationField::new('gender')
                ->setLabel('Genre'),
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof CareSummary) return;

        $entityInstance->setUpdatedAt(new \DateTimeImmutable());

        parent::updateEntity($entityManager, $entityInstance);
    }
}
