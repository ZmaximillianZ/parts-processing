<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WorkerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $worker = null;
        foreach (static::getInfo() as $item) {
            $user = $this->getReference("user_$item[4]");
            $worker = $this->createWorker($item[0], $item[1], $item[2], $item[3], $user);
            $manager->persist($worker);
            $this->addReference("worker_$item[4]", $worker);
        }
        $manager->flush();
    }

    private function createWorker(
        string $position,
        int $status,
        bool $isQualification,
        int $qualification,
        User $user
    ): Worker
    {
        return (new Worker())
            ->setIsQualification($isQualification)
            ->setPosition($position)
            ->setUser($user)
            ->setStatus($status)
            ->setQualification($qualification)
        ;
    }

    private static function getInfo(): array
    {
        return [
            ['Токарь', Worker::EMPLOYED, true, 10, 1],
            ['Токарь', Worker::EMPLOYED, true, 10, 2],
            ['Токарь', Worker::EMPLOYED, true, 10, 3],
            ['Токарь', Worker::FIRED, false, 5, 4],
            ['Мастер', Worker::EMPLOYED, true, 20, 5],
            ['Мастер', Worker::EMPLOYED, true, 10, 6],
            ['Фрейзеровщик', Worker::EMPLOYED, true, 15, 7],
            ['Фрейзеровщик', Worker::EMPLOYED, true, 20, 8],
            ['Фрейзеровщик', Worker::ON_HOLIDAY, true, 10, 9],
            ['Оператор ЧПУ', Worker::EMPLOYED, true, 10, 10],
            ['Оператор ЧПУ', Worker::EMPLOYED, true, 15, 11],
            ['Оператор ЧПУ', Worker::EMPLOYED, true, 15, 12],
            ['Оператор ЧПУ', Worker::ON_SICK_LEAVE, true, 10, 13],
            ['Инженер-Технолог', Worker::EMPLOYED, true, 20, 14],
            ['Инженер-Технолог', Worker::EMPLOYED, true, 20, 15],
            ['Слесарь', Worker::EMPLOYED, true, 10, 16],
            ['Слесарь', Worker::EMPLOYED, true, 15, 17],
            ['Слесарь', Worker::EMPLOYED, false, 15, 18],
            ['Специалист ОТК', Worker::EMPLOYED, true, 10, 19],
            ['Специалист ОТК', Worker::EMPLOYED, true, 10, 20],
        ];
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
