<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EquipmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $equipment = null;
        foreach (static::getInfo() as $item) {
            $equipment = $this->createEquipment($item[0], $item[1], $item[2], $item[3]);
            $manager->persist($equipment);
            $this->addReference("equipment_$item[4]", $equipment);
        }
        $manager->flush();
    }

    private function createEquipment(
        $name,
        $type,
        $status,
        $accuracy
    ): Equipment
    {
        return (new Equipment())
                ->setName($name)
                ->setType($type)
                ->setStatus($status)
                ->setAccuracy($accuracy)
            ;
    }

    private static function getInfo(): array
    {
        return [
            ['Токарный станок JET BD-3', 1, 1, 1.00, 1],
            ['Токарный станок Jet BD-8VS', 1, 1, 1.00, 2],
            ['Токарный станок Энкор Корвет-401', 1, 0, 2.00, 3],
            ['Фрезерный станок Jet JTM-1254EVS', 2, 1, 1.00, 4],
            ['Фрезерный станок Энкор Корвет-82', 2, 1, 1.00, 5],
            ['Фрезерный станок Jet JMD-1L', 2, 1, 1.00, 6],
            ['ЧПУ станок VMC B', 3, 1, 1.00, 7],
            ['ЧПУ станок VMС C', 3, 1, 1.00, 8],
            ['ЧПУ станок GMC', 3, 0, 2.00, 9],
        ];
    }
}
