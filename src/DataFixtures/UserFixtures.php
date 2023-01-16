<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    const USERS = [
        [
            "email" => "medecin@medecin.fr",
            "password" => "medecin",
        ],
        [
            "email" => "infirmier@infirmier.fr",
            "password" => "infirmier",
        ],
        [
            "email" => "client@medecin.fr",
            "password" => "client",
        ]
    ];
    private UserPasswordHasherInterface $passwordHash;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHash = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        foreach (self::USERS as $key => $user)
        {
            $newUser = new User();
            $newUser
                ->setEmail($user['email'])
                ->setPassword($this->passwordHash->hashPassword(
                    $newUser,
                    $user['password']
                ))
                ->setRole($this->getReference('role_' . ($key + 1)));
            $manager->persist($newUser);
            $this->addReference('user_' . ($key + 1), $newUser);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            RoleFixtures::class
        ];
    }

}
