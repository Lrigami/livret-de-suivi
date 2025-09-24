<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();

        $user->setEmail('user@user.fr');
        $user->setRoles(['ROLE_APPRENANT']);
        $hashedPassword = $this->hasher->hashPassword($user, 'password');
        $user->setPassword($hashedPassword);
        $user->setFirstName('Nono');
        $user->setLastName('Le petit robot');
        $manager->persist($user);
        $this->setReference('user', $user);

        $admin = new User();
        
        $admin->setEmail('admin@admin.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->hasher->hashPassword($admin, 'password');
        $admin->setPassword($hashedPassword);
        $admin->setFirstName('Capitaine');
        $admin->setLastName('Flamme');
        $manager->persist($admin);
        $this->setReference('admin', $admin);
        
        $manager->flush();
    }
}
