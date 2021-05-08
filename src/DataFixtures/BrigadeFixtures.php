<?php

namespace App\DataFixtures;

use App\Entity\Brigade;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BrigadeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $brigade = null;
        foreach (static::getInfo() as $item) {
            $workers = [];
            foreach ($item[3] as $id) {
                $workers[] = $this->getReference("worker_$id");
            }
            $brigade = $this->createBrigade($item[0], $item[1], $item[2], $workers);
            $manager->persist($brigade);
            $this->addReference("brigade_$item[4]", $brigade);
        }

        $manager->flush();
    }

    private function createBrigade(
        $setWorkShift,
        $setType,
        $setStatus,
        $addWorkers
    ): Brigade {
        return (new Brigade())
            ->setWorkShift($setWorkShift)
            ->setType($setType)
            ->setStatus($setStatus)
            ->addWorkers($addWorkers)
        ;
    }

    private static function getInfo(): array
    {
        return [
            [1, 1, 1, [1, 2, 5, 7, 8, 10, 11, 14, 16, 19], 1],
            [2, 1, 1, [3, 6, 9, 12, 13, 15, 17, 18, 20], 2],
        ];
    }

    public function getDependencies()
    {
        return [
            WorkerFixtures::class
        ];
    }
}
