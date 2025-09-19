<?php

namespace App\Controller\Admin;

use App\Entity\Booklet;
use App\Form\BookletPeriodFormType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookletCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Booklet::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('student', 'Apprenant')
                ->setFormTypeOptions(['disabled' => true]),
            AssociationField::new('formation', 'Formation')
                ->setFormTypeOptions(['disabled' => true]),
            BooleanField::new('archived')->hideOnForm(),
            CollectionField::new('bookletPeriods', 'Périodes')
                ->onlyOnForms()
                ->allowAdd(false)
                ->allowDelete(false)
                ->setEntryType(BookletPeriodFormType::class)
                ->setEntryIsComplex(true) // indique qu’on ne veut pas créer de nouvelles entités
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
        ];
    }
}
