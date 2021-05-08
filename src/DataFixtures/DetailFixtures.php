<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DetailFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    private static function getInfo(): array
    {
        return [
            ['', '', 1],
            ['', '', 2],
            ['', '', 3],
            ['', '', 4],
            ['', '', 5],
            ['', '', 6],
            ['', '', 7],
            ['', '', 8],
            ['', '', 9],
            ['', '', 10],
            ['', '', 11],
            ['', '', 12],
            ['', '', 13],
            ['', '', 14],
            ['', '', 15],
            ['', '', 16],
            ['', '', 17],
            ['', '', 18],
            ['', '', 19],
            ['', '', 20],
        ];
    }
}
