<?php

namespace App\DataFixtures;

use App\Entity\TechnologicalMap;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TechnologicalMapFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tm = null;
        foreach (static::getInfo() as $item) {

            $processes = [];
            foreach ($item[7] as $id) {
                $processes[] = $this->getReference("process_$id");
            }
            $tm = $this->createTechnologicalMap($item[0], $item[1], $item[2], $item[3], $item[4], $item[5], $item[6], $processes);
            $manager->persist($tm);
            $this->addReference("technological_map_$item[8]", $tm);
        }
        $manager->flush();
    }

    private function createTechnologicalMap(
        $name,
        $x,
        $y,
        $z,
        $tolerance,
        $weight,
        $materialGrade,
        $processes
    ): TechnologicalMap
    {
        return (new TechnologicalMap())
            ->setName($name)
            ->setX($x)
            ->setY($y)
            ->setZ($z)
            ->setWeight($weight)
            ->setTolerance($tolerance)
            ->setMaterialGrade($materialGrade)
            ->addProcesses($processes)
        ;
    }

    private static function getInfo(): array
    {
        return [
            ['Планка №1', 12.5, 32.5, 45.0, 0.005, 0.01, 'сталь X12CrNiTi18-10', [1, 2, 3, 4], 1],
            ['Втулка №1', 44.5, 25.5, 87.0, 0.052, 0.01, 'сталь 09Г2С-10', [5, 6, 7], 2],
            ['Рычаг №1', 10.5, 32.5, 22.0, 0.005, 0.01, 'сталь 09Г2С-10', [8, 9, 10], 3],
            ['Диск №1', 20.5, 32.5, 22.0, 0.105, 0.01, 'сталь 20ЮЧА-10', [11, 12, 13], 4],
            ['Цилиндр №1', 30.5, 12.5, 40.0, 1.005, 0.01, 'сталь X12CrNiTi18-10', [1, 2, 3, 4], 5],
            ['Кронштейн №1', 25.5, 55.5, 40.0, 2.005, 0.01, 'сталь X12CrNiTi18-10', [5, 6, 7], 6],
            ['Патрубок №1', 45.5, 55.5, 39.0, 0.300, 0.01, 'сталь X12CrNiTi18-10', [8, 9, 10], 7],
            ['Эксцентриковый вал №1', 33.5, 43.5, 39.0, 0.500, 0.01, 'сталь X12CrNiTi18-10', [11, 12, 13], 8],
            ['Коленчатый вал №1', 43.5, 43.5, 20.0, 0.005, 0.01, 'сталь X12CrNiTi18-10', [1, 2, 3, 4], 9],
            ['Планка №2', 20.5, 30.5, 20.0, 0.200, 0.01, 'сталь X12CrNiTi18-10', [5, 6, 7],10],
            ['Втулка №2', 120.5, 30.5, 79.0, 0.005, 0.01, 'сталь X12CrNiTi18-10', [8, 9, 10],11],
            ['Рычаг №2', 60.5, 10.5, 79.0, 0.800, 0.01, 'сталь X12CrNiTi18-10', [11, 12, 13],12],
            ['Диск №2', 12.5, 10.5, 90.0, 0.505, 0.01, 'сталь X12CrNiTi18-10', [1, 2, 3, 4],13],
            ['Цилиндр №2', 30.5, 25.5, 90.0, 0.305, 0.01, 'сталь X11CrNiTi18-10', [5, 6, 7],14],
            ['Кронштейн №2', 35.5, 25.5, 40.0, 0.205, 0.01, 'сталь X11CrNiTi18-10', [8, 9, 10],15],
            ['Патрубок №2', 23.5, 50.5, 40.0, 2.000, 0.01, 'сталь X12CrNiTi17-10', [11, 12, 13],16],
            ['Эксцентриковый вал №2', 66.5, 50.5, 30.0, 0.200, 0.01, 'сталь X12CrNiTi17-10', [1, 2, 3, 4], 17],
            ['Коленчатый вал №2', 23.5, 70.5, 30.0, 0.500, 0.01, 'сталь X12CrNiTi22-10', [5, 6, 7], 18],
            ['Планка №2', 82.5, 70.5, 20.0, 0.100, 0.01, 'сталь X12CrNiTi22-10', [8, 9, 10], 19],
            ['Планка №2', 12.5, 11.5, 20.0, 0.555, 0.01, 'сталь X10CrNiTi11-10', [11, 12, 13], 20],
        ];
    }

    public function getDependencies()
    {
        return [ProcessFixtures::class];
    }
}
