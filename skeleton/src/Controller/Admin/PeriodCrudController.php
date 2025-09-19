<?php

namespace App\Controller\Admin;

use App\Entity\Period;
use App\Enum\PeriodType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PeriodCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Period::class;
    }

    public function createEntity(string $entityFqcn) 
    {
        return new Period();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            ChoiceField::new('type', 'Type')
                ->setFormType(ChoiceType::class)
                ->setFormTypeOptions([
                    'choices' => PeriodType::cases(),       // toutes les instances de l’enum
                    'choice_label' => fn(PeriodType $pt) => $pt->value,  // ce qui s’affiche
                    'choice_value' => fn(?PeriodType $pt) => $pt?->name, // ce qui est stocké
                ]),
            DateTimeField::new('startDate', 'Début le')
                ->setFormTypeOptions([
                    'widget' => 'single_text',
                    'html5' => true,
                    'data' => (new \DateTimeImmutable())->setTime(8, 45), // 08h45 par défaut
                ]),
            DateTimeField::new('endDate', 'Fin le')
                ->setFormTypeOptions([
                    'widget' => 'single_text',
                    'html5' => true,
                    'data' => (new \DateTimeImmutable())->setTime(16, 45), // 16h45 par défaut
                ]),
        ];
    }
}
