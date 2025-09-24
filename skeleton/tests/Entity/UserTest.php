<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class UserTest extends TestCase
{
    public function testGetFirstName(): void
    {
        $user = new User();
        $user->setFirstName('Test first name');
        $this->assertEquals('Test first name', $user->getFirstName());
    }

    public function testInvalidUser()
    {
        $user = new User();

        $validator = Validation::createValidatorBuilder()
            ->enableAttributeMapping()
            ->getValidator();

        $violations = $validator->validateProperty($user, 'email');

        $this->assertCount(1, $violations);

        $this->assertSame(
            "L'adresse email est obligatoire.",
            $violations[0]->getMessage()
        );

        $user->setEmail('invalid_email');
        $violations = $validator->validateProperty($user, 'email');
        $this->assertCount(1, $violations);
    }
}
