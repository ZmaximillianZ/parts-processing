<?php

namespace App\DataFixtures;

use App\Entity\Process;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProcessFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $process = null;
        foreach (static::getInfo() as $item) {
            $equipment = $this->getReference("equipment_$item[3]");
            $process = $this->createProcess($item[0], $item[1], $item[2], $equipment, $item[4], $item[5]);
            $manager->persist($process);
            $this->addReference("process_$item[6]", $process);
        }
        $manager->flush();
    }

    private function createProcess(
        $name,
        $type,
        $status,
        $equipment,
        $qualification,
        $time
    ): Process
    {
        return (new Process())
            ->setName($name)
            ->setType($type)
            ->setStatus($status)
            ->setEquipment($equipment)
            ->setQualification($qualification)
            ->setTime($time)
        ;
    }

    private static function getInfo(): array
    {
        return [
            ['Сверлить 2 отв. 1,5Н12 по центровкам (при необхордимости)', 1, 1, 1, 10, 60,  1],
            ['Снять заусенцы; притупить острые кромки до R0,2 мм max', 2, 1, 4, 10, 120, 2],
            ['Подготовка детали согласно артикулу #3214K67', 3, 1, 7, 10, 30,  3],
            ['Подготовка детали согласно артикулу #3224K63', 3, 1, 7, 10, 40,  4],

            ['Фрезеровать пах 11Н12 в размер 11 (черт. 0,5 + 9,5 --технолог.) Согласно чертежу', 2, 1, 2, 10, 15,  5],
            ['Фрезеровать (предварительно; с припуском 0.1 мм на сторону)', 3, 1, 5, 5,  20,  6],
            ['Центровать при необходимости: 2 отв. ф1.5Н12 согласно чертежу', 1, 1, 8, 10, 30,  7],

            ['Снять заусенцы. притупить острые кромки до R0,2 mm max.', 2, 1, 3, 5,  60, 8],
            ['Шлифовать плоск. основания в размер 2.4-0.05', 3, 1, 6, 10, 60, 9],
            ['Просверлить боковые шарниры согласно чертежу', 1, 1, 9, 10, 60, 10],

            ['Шлифовать центральную кромку до 1.1', 2, 1, 3, 15, 40, 11],
            ['Подготовка детали согласно артикулу #114K63', 3, 1, 6, 5, 120, 12],
            ['Подготовка детали согласно артикулу #32222K13 детали: шаг 3', 3, 1, 9, 15, 20, 13],
//            ['Подготовка детали: шаг ', '', 14],
//            ['Подготовка детали: шаг ', '', 15],
//            ['Подготовка детали: шаг ', '', 16],
//            ['Подготовка детали: шаг ', '', 17],
//            ['Подготовка детали: шаг ', '', 18],
//            ['Подготовка детали: шаг ', '', 19],
//            ['Подготовка детали: шаг ', '', 20],
        ];
    }

    public function getDependencies()
    {
        return [ToolFixtures::class, EquipmentFixtures::class];
    }
}
