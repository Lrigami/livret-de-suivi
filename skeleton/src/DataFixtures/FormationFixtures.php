<?php

namespace App\DataFixtures;

use App\Entity\User;
use DatetimeImmutable;
use App\Entity\Formation;
use App\Entity\FormationType;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\FormationTypeFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FormationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $formation = new Formation();

        $formation->setName('CDA 2025 - 2026');
        $formation->setTeacher($this->getReference('admin', User::class));
        $formation->setType($this->getReference('formationType', FormationType::class));
        $formation->setBeginAt(new DatetimeImmutable('2025-07-07 08:45:00'));
        $formation->setEndAt(new \DatetimeImmutable('2026-06-19 16:45:00'));
        $formation->setBeginStageAt(new \DatetimeImmutable('2026-02-11 08:45:00'));
        $formation->setEndStageAt(new \DatetimeImmutable('2026-04-30 16:45:00'));
        $formation->setStorage(false);
        $formation->setNbHourCenter(1345);
        $formation->setNbHourStage(390);
        $manager->persist($formation);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            FormationTypeFixtures::class,
        ];
    }
}
