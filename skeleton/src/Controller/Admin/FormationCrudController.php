<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Period;
use App\Entity\Booklet;
use App\Entity\Formation;
use App\Entity\BookletPeriod;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use App\Controller\Admin\FormationTypeCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $formation = new Formation();
        $formation->setStorage(false);

        // Création d'un objet Formation vide
        return $formation;
    }

    private function computeHours(Formation $formation): void
    {
        $nbHoursTotal = 0;
        $nbHoursStage = 0;

        if ($formation->getBeginAt() && $formation->getEndAt()) {
            $intervalTotal = $formation->getBeginAt()->diff($formation->getEndAt());
            $daysTotal = (int) $intervalTotal->days;
            $nbHoursTotal = ($daysTotal / 7) *35; 
        }

        if ($formation->getBeginStageAt() && $formation->getEndStageAt()) {
            $intervalStage = $formation->getBeginStageAt()->diff($formation->getEndStageAt());
            $daysStage = (int) $intervalStage->days;
            $nbHoursStage = ($daysStage / 7) *35;
        }
        
        $nbHoursCenter = $nbHoursTotal - $nbHoursStage;

        $formation->setNbHourStage($nbHoursStage);
        $formation->setNbHourCenter($nbHoursCenter);
    }

    private function createBooklets(Formation $formation, EntityManagerInterface $em): void
    {
        // Récupérer toutes les periods formation/stage qui chevauchent la formation
        $periods = $em->getRepository(Period::class)->createQueryBuilder('p')
            ->andWhere('p.start_date <= :end')
            ->andWhere('p.end_date >= :start')
            ->setParameter('start', $formation->getBeginAt())
            ->setParameter('end', $formation->getEndAt())
            ->getQuery()
            ->getResult();

        $bookletRepo = $em->getRepository(Booklet::class);
        $bookletPeriodRepo = $em->getRepository(BookletPeriod::class);

        foreach ($formation->getStudent() as $student) {

            // Vérifie si un booklet existe déjà pour cet étudiant et cette formation
            $existingBooklet = $bookletRepo->findByStudentAndFormation($student, $formation);
            $booklet = '';
            // Si un livret n'existe pas, on le crée et on l'assigne
            if (!$existingBooklet) {
                $booklet = new Booklet();
                $booklet->setStudent($student);
                $booklet->setFormation($formation);
                $booklet->setArchived(false);
            } 
            // sinon on récupère le livret actuel de l'étudiant
            else {
                $booklet = $existingBooklet;
            }
            
            // On ajoute les périodes filtrées si elles ne sont pas déjà présentes
            foreach ($periods as $period) {
                // si elle existe déjà, on ne l'ajoute pas
                $existingBP = $bookletPeriodRepo->findOneBy([
                    'booklet' => $booklet,
                    'period' => $period,
                ]);

                if ($existingBP) {
                    continue; // déjà associé
                }
                // sinon on l'ajoute
                $bookletPeriod = new BookletPeriod();
                $bookletPeriod->setBooklet($booklet);
                $bookletPeriod->setPeriod($period);
                $em->persist($bookletPeriod);
            }

            $em->persist($booklet);
        }
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
      if ($entityInstance instanceof Formation) {
            $this->computeHours($entityInstance);
            $this->createBooklets($entityInstance, $entityManager);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Formation) {
            $this->computeHours($entityInstance);
            $this->createBooklets($entityInstance, $entityManager);
        }

        parent::updateEntity($entityManager, $entityInstance);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom de la formation'),
            AssociationField::new('teacher', 'Formateur')
                ->setQueryBuilder(function ($qb) {
                    return $qb
                    ->andWhere("entity.roles LIKE :role")
                    ->setParameter('role', '%ROLE_ADMIN%');
                }),
            AssociationField::new('type', 'Type de formation'),
            // ->renderAsEmbeddedForm(FormationTypeCrudController::class),
            DateTimeField::new('beginAt', 'Débute le'),
            DateTimeField::new('endAt', 'Termine le'),
            DateTimeField::new('beginStageAt', 'Début du stage le'),
            DateTimeField::new('endStageAt', 'Fin du stage le'),
            // Permet de voir combien d'apprenants une formation contient, uniquement sur l'index
            IntegerField::new('student', 'Apprenants')
                ->formatValue(function($value, $entity) {
                    return $entity->getStudent()->count();
                })
                ->onlyOnIndex(),
            AssociationField::new('student', 'Apprenants')
                ->setQueryBuilder(function ($qb) {
                    return $qb
                    ->andWhere("entity.roles LIKE :role")
                    ->setParameter('role', '%ROLE_APPRENANT%');
                })
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->onlyOnForms(),
            // CollectionField::new('students')
            //     ->allowAdd(true)
            //     ->allowDelete(true)
            //     ->setEntryType(User::class)
            //     ->onlyOnForms(),
        ];
    }
}
