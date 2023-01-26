<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Gender;

class GenderFixtures extends Fixture
{
    const GENDERS = [
        ["slug" => "feminin", "gender" => "Madame"], // index 0 + 1 = 1
        ["slug" => "masculin", "gender" => "Monsieur"], // index 1 + 1 = 2
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::GENDERS as $key => $gender)
        {
            $newGender = new Gender();
            $newGender
                ->setType($gender['gender'])
                ->setSlug($gender['slug']);
            $manager->persist($newGender);
            $this->addReference('gender_' . ($key + 1), $newGender);
        }

        $manager->flush();
    }
}
