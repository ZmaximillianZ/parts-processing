<?php

namespace App\DataFixtures;

use App\Entity\Detail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DetailFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $detail = null;
        foreach (static::getInfo() as $item) {
            $tm = $this->getReference("technological_map_$item[2]");
            $detail = $this->createDetail($item[0], $item[1], $tm);
            $manager->persist($detail);
            $this->addReference("detail_$item[3]", $detail);
        }
        $manager->flush();
    }

    private function createDetail(
        $name,
        $status,
        $tm
    ): Detail
    {
        return (new Detail())
            ->setName($name)
            ->setStatus($status)
            ->setTechnologicalMap($tm)
        ;
    }

    private static function getInfo(): array
    {
        return [
            ['Планка №1', 1, 1, 1],
        ];
    }

    public function getDependencies()
    {
        return [TechnologicalMapFixtures::class];
    }
}
