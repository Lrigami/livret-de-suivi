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
        // un formateur peut consulter tous les livrets, et les exporter
        // mais seul le formateur de la formation à laquelle appartient le livret
        // peut éditer le livret de suivi en question

        $student = AssociationField::new('student', 'Apprenant')
            ->setFormTypeOptions(['disabled' => true]);

        $formation =  AssociationField::new('formation', 'Formation')
            ->setFormTypeOptions(['disabled' => true]);

        // par défaut l'archivage du livret de suivi est désactivée. 
        $isArchived = BooleanField::new('archived')->hideOnForm()
            ->setFormTypeOptions(['disabled' => true]);

        $filteredBookletPeriods = CollectionField::new('filteredBookletPeriods', 'Périodes')
                ->onlyOnForms()
                ->allowAdd(false)
                ->allowDelete(false)
                ->setEntryType(BookletPeriodFormType::class)
                ->setEntryIsComplex(true) // indique qu’on ne veut pas créer de nouvelles entités
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]);

        // Seul un super admin peut archiver prématurément un livret de suivi d'un apprenant. 
        if(in_array("ROLE_SUPERADMIN", $this->getUser()->getRoles()))
        {
            $isArchived->setFormTypeOptions(['disabled' => false]);
        }

        return [
            $student,
            $formation, 
            $isArchived, 
            $filteredBookletPeriods,
        ];
    }
}
