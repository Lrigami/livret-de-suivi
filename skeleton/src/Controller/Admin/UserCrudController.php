<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $user = new User();
        $user->setRoles(['user']);
        return $user;
    }

    public function configureFields(string $pageName): iterable
    {
        $password = TextField::new('password')
            ->setLabel("Mot de passe")
            ->setFormType(PasswordType::class)
            ->setFormTypeOption('empty_data', '')
            ->hideOnIndex();

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstName', 'Prénom'),
            TextField::new('lastName', 'Nom'),
            EmailField::new('email'),
            $password,
            ChoiceField::new('roles', 'Roles')
                ->allowMultipleChoices()
                ->autocomplete()
                ->setChoices(
                    [
                        'Apprenant' => 'user',
                        'User' => 'user',
                        'Formateur' => 'admin'
                    ]
                )
        ];
    }
}
