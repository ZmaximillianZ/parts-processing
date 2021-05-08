<?php

namespace App\DataFixtures;

use App\Entity\Tool;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ToolFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tool = null;
        foreach (static::getInfo() as $item) {
            $tool = $this->createTool($item[0], $item[1], $item[2]);
            $manager->persist($tool);
            $this->addReference("tool_$item[3]", $tool);
        }
        $manager->flush();
    }

    private function createTool(
        $name,
        $status,
        $type
    ): Tool
    {
        return (new Tool())
            ->setName($name)
            ->setStatus($status)
            ->setType($type)
        ;
    }

    private static function getInfo(): array
    {
        return [
            ['Молоток', 1, 1, 1],
            ['Пласкогубцы', 1, 2, 2],
            ['Отвертка -', 1, 3, 3],
            ['Лом', 1, 4, 4],
            ['Линейка', 1, 5, 5],
            ['Держатель', 1, 6, 6],
            ['Тиски', 1, 7, 7],
            ['Отвертка +', 1, 3, 8],
            ['Напильник 1', 1, 8, 9],
            ['Напильник 2', 1, 8, 10],
            ['Напильник 3', 1, 8, 11],
            ['Напильник 4', 1, 8, 12],
            ['Напильник 5', 1, 8, 13],
            ['Кувалда', 1, 9, 14],
        ];
    }
}
