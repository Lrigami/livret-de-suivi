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
        return $user;
    }

    public function configureFields(string $pageName): iterable
    {
        $password = TextField::new('password')
            ->setLabel("Mot de passe")
            ->setFormType(PasswordType::class)
            ->setFormTypeOption('empty_data', '')
            ->setDisabled(true)
            ->hideOnIndex();
        if(in_array("ROLE_SUPERADMIN", $this->getUser()->getRoles()))
        {
            $password->setDisabled(false); 
        }

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
                        'Apprenant' => 'ROLE_APPRENANT',
                        'User' => 'ROLE_USER',
                        'Formateur' => 'ROLE_ADMIN'
                    ]
                )
        ];
    }
}
