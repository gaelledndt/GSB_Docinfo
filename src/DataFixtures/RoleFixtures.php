<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    const ROLES = [
        ["slug" => "medecin", "role" => "Medecin"], // index 0 + 1 = 1
        ["slug" => "infirmier", "role" => "Infirmier"], // index 1 + 1 = 2
        ["slug" => "client", "role" => "Client"],// index 2 + 1 = 3
        ["slug" => "admin", "role" => "Admin"],// index 3 + 1 = 4
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::ROLES as $key => $role)
        {
            $newRole = new Role();
            $newRole
                ->setRole($role['role'])
                ->setSlug($role['slug']);
            $manager->persist($newRole);
            $this->addReference('role_' . ($key + 1), $newRole);
        }
        $manager->flush();
    }
}
