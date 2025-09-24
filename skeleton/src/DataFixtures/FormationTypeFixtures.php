<?php

namespace App\DataFixtures;

use App\Entity\FormationType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FormationTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $formationType = new FormationType();

        $formationType->setName('TP - Concepteur développeur d\'applications');
        $formationType->setDetail(null);
        $formationType->setCode('RNCP37873');
        $manager->persist($formationType);
        $this->setReference('formationType', $formationType);

        $manager->flush();
    }
}
