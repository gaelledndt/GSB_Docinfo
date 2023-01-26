<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\TestResultType;

class TestResultTypeFixtures extends Fixture
{
    const TESTRESULTTYPE = [
        ["testResultType" => "Covid"],
        ["testResultType" => "Diabète"],
        ["testResultType" => "Cancer"],
        ["testResultType" => "Grippe"],
        ["testResultType" => "Prise de sang"],
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::TESTRESULTTYPE as $key => $testResultType)
        {
            $newTestResultType = new TestResultType();
            $newTestResultType
                ->setType($testResultType['testResultType']);
            $manager->persist($newTestResultType);
            $this->addReference('testResultType_' . ($key + 1), $newTestResultType);
        }

        $manager->flush();
    }
}
