<?php

namespace App\Controller\Admin;

use App\Entity\CareSummary;
use App\Form\AllergenicForm;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
class CareSummaryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CareSummary::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Dossier de santé');
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
            AssociationField::new('user')
                ->setLabel('A quel utilisateur ?'),
            AssociationField::new('doctor_referring')
                ->setLabel('Le médecin référent'),
            AssociationField::new('gender')
                ->setLabel('Genre'),
            CollectionField::new('allergenic')
               ->setLabel('Allergies')
               ->setEntryType(AllergenicForm::class),
            DateTimeField::new('created_at')
                ->setLabel('Date de création')
                ->hideOnForm(),
            DateTimeField::new('updated_at')
                ->setLabel('Mise à jour le')
                ->hideOnForm(),
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof CareSummary) return;

        $entityInstance->setUpdatedAt(new \DateTimeImmutable());

        parent::updateEntity($entityManager, $entityInstance);
    }
}
