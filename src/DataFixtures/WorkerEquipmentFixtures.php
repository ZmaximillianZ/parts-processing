<?php

namespace App\DataFixtures;

use App\Entity\WorkerEquipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WorkerEquipmentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $workerEquipment = null;
        foreach (static::getInfo() as $item) {
            $equipment = $this->getReference("equipment_$item[1]");
            $worker = $this->getReference("worker_$item[2]");
            $workerEquipment = $this->createWorkerEquipment($item[0], $equipment, $worker);
            $manager->persist($workerEquipment);
            $this->addReference("worker_equipment_$item[3]", $workerEquipment);
        }
        $manager->flush();
    }

    private function createWorkerEquipment(
        $qualification,
        $equipment,
        $worker
    ): WorkerEquipment
    {
        return (new WorkerEquipment())
                ->setQualification($qualification)
                ->setEquipment($equipment)
                ->setWorker($worker)
            ;
    }

    private static function getInfo(): array
    {
        return [
            // токаря с токарным стонками
            [10, 1, 1, 1],
            [10, 1, 2, 2],
            [10, 1, 3, 3],
            [10, 1, 4, 4],
            [10, 2, 1, 5],
            [10, 2, 2, 6],
            [10, 2, 3, 7],
            [10, 2, 4, 8],
            [10, 3, 1, 9],
            [10, 3, 2, 10],
            [10, 3, 3, 11],
            [10, 3, 4, 12],

            // Фрейзеровщики со слесарями на Фрейзерных станках
            [10, 4, 7, 13],
            [10, 4, 8, 14],
            [10, 4, 9, 15],
            [10, 4, 16, 16],
            [10, 4, 17, 17],
            [10, 4, 18, 18],
            [10, 5, 7, 19],
            [10, 5, 8, 20],
            [10, 5, 9, 21],
            [10, 5, 16, 22],
            [10, 5, 17, 23],
            [10, 5, 18, 24],
            [10, 6, 7, 25],
            [10, 6, 8, 26],
            [10, 6, 9, 27],
            [10, 6, 16, 28],
            [10, 6, 17, 29],
            [10, 6, 18, 30],

            // Операторы ЧПУ на станках ЧПУ
            [10, 7, 10, 31],
            [10, 7, 11, 32],
            [10, 7, 12, 33],
            [10, 8, 10, 34],
            [10, 8, 11, 35],
            [10, 8, 12, 36],
            [10, 9, 10, 37],
            [10, 9, 11, 38],
            [10, 9, 12, 39],

            // токаря на Фрейзерных станках
            [5, 4, 1, 40],
            [5, 5, 2, 41],
            [5, 6, 3, 42],
            [5, 4, 1, 43],
            [5, 5, 2, 44],
            [5, 6, 3, 45],
            [5, 4, 1, 46],
            [5, 5, 2, 47],
            [5, 6, 3, 48],

            // Фрейзеровщики с токарным стонками
            [5, 1, 7, 49],
            [5, 1, 8, 50],
            [5, 1, 9, 51],
            [5, 2, 7, 52],
            [5, 2, 8, 53],
            [5, 2, 9, 54],
            [5, 3, 7, 55],
            [5, 3, 8, 56],
            [5, 3, 9, 57],
        ];
    }

    public function getDependencies()
    {
        return [WorkerFixtures::class, EquipmentFixtures::class];
    }
}
