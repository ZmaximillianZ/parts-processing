<?php

namespace App\DataFixtures;

use App\Entity\WorkerEquipmentDetailProcess;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WorkerEquipmentDetailProcessFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $workerEquipmentDetailProcess = null;
        foreach (static::getInfo() as $item) {
            $workerEquipment = $this->getReference("worker_equipment_$item[2]");
            $detail = $this->getReference("detail_$item[2]");
            $workerEquipmentDetailProcess = $this->createWorkerEquipmentDetailProcess($workerEquipment, $item[1], $detail);
            $manager->persist($workerEquipmentDetailProcess);
            $this->addReference("worker_equipment_detail_process_$item[3]", $workerEquipmentDetailProcess);
        }
        $manager->flush();
    }

    private function createWorkerEquipmentDetailProcess(
        $we,
        $time,
        $detail
    ): WorkerEquipmentDetailProcess
    {
        return (new WorkerEquipmentDetailProcess())
            ->setWorkerEquipment($we)
            ->setTime($time)
            ->setDetail($detail)
        ;
    }

    private static function getInfo(): array
    {
        return [
            [1, 60, 1, 1],
        ];
    }

    public function getDependencies()
    {
        return [DetailFixtures::class, WorkerEquipmentFixtures::class];
    }
}
