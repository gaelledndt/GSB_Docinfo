<?php

namespace App\DataFixtures;

use App\Entity\Allergenic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AllergenicFixtures extends Fixture
{
    const ALLERGENIC = [
        ["allergenic" => "Acariens"],
        ["allergenic" => "Lait"],
        ["allergenic" => "Chat"],
        ["allergenic" => "Chien"],
        ["allergenic" => "Pollens "],
        ["allergenic" => "Moisissures"],
        ["allergenic" => "Noix"],
        ["allergenic" => "Fruits à coque"],
        ["allergenic" => "Insectes "],
        ["allergenic" => "Médicaments "],
        ["allergenic" => "Produits chimiques "],
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::ALLERGENIC as $key => $allergenic)
        {
            $newAllergenic = new Allergenic();
            $newAllergenic
                ->setName($allergenic['allergenic']);
            $manager->persist($newAllergenic);
            $this->addReference('allergenic_' . ($key + 1), $newAllergenic);
        }

        $manager->flush();
    }
}
