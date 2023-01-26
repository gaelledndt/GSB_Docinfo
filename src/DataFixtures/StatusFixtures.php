<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Status;

class StatusFixtures extends Fixture
{
    const STATUS = [
        ["status" => "Critique"],
        ["status" => "Grave"],
        ["status" => "A surveiller"],
        ["status" => "En voie de rétablissement"],
        ["status" => "En convalence"],
        ["status" => "Rétablis"],
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::STATUS as $key => $status)
        {
            $newStatus = new Status();
            $newStatus
                ->setStatus($status['status']);
            $manager->persist($newStatus);
            $this->addReference('status_' . ($key + 1), $newStatus);
        }

        $manager->flush();
    }
}
