<?php

namespace App\Controller\Admin;

use App\Form\ActivityType;
use App\Entity\FormationType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormationTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FormationType::class;
    }

    public function createEntity(string $entityFqcn)
    {
        return new FormationType();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Titre'),
            TextEditorField::new('detail', 'Détails')->hideOnIndex(),
            TextField::new('code', 'Code de référence'),
            CollectionField::new('activity', 'Activités types')
                ->allowAdd(true)
                ->allowDelete(true)
                ->setEntryType(ActivityType::class)
                ->onlyOnForms()
        ];
    }
}
