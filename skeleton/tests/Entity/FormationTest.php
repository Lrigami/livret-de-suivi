<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Entity\Formation;
use PHPUnit\Framework\TestCase;

class FormationTest extends TestCase
{
    public function testAddUser(): void
    {
        $user = new User();
        $user->setEmail("test@test.fr");
        $formation = new Formation();
        $formation->setName('CDA');

        $formation->addStudent($user);

        $this->assertCount(1, $formation->getStudent());
        $this->assertTrue($formation->getStudent()->contains($user));
    }

    public function testRemoveUser(): void 
    {
        $user = new User();
        $user->setEmail("test@test.fr");
        $formation = new Formation();
        $formation->setName('CDA');

        $formation->addStudent($user);

        $formation->removeStudent($user);

        $this->assertCount(0, $formation->getStudent());
        $this->assertFalse($formation->getStudent()->contains($user));
    }
}
