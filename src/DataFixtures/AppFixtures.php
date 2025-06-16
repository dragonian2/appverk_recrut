<?php

namespace App\DataFixtures;

use App\Entity\User;
use Ramsey\Uuid\Uuid;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as PasswHash;

class AppFixtures extends Fixture
{
    public function __construct(
        private PasswHash $passwordHasher, // Inject the password hasher service
    )
    {}

    public function load(ObjectManager $manager): void
    {
        $users = [
            [
                'id' => Uuid::uuid4()->toString(),
                'username' => 'user',
                'roles' => ['ROLE_USER'],
                'password' => 'haslo123',
                'isVerified' => true,
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'username' => 'admin',
                'roles' => ['ROLE_USER', 'ROLE_ADMIN'],
                'password' => 'haslo123',
                'isVerified' => true,
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user->setId($userData['id']);
            $user->setUsername($userData['username']);
            $user->setRoles($userData['roles']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $userData['password']));
            $user->setIsVerified($userData['isVerified']);
            $user->setCreatedAt($userData['createdAt']);
            $user->setUpdatedAt($userData['updatedAt']);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
