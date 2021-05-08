<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $max = new User();
        $max
            ->setFirstName('Максим')
            ->setLastName('Гришин')
            ->setMiddleName('Александрович')
            ->setEmail('goooglemax1993@gmail.com')
            ->setStatus(User::ACTIVE);
        $manager->persist($max);
        $this->addReference('user_max', $max);
        $user = null;
        foreach (static::getInfo() as $item) {
            $user = $this->createUser($item[0], $item[1], $item[2], $item[3], $item[4]);
            $manager->persist($user);
            $this->addReference("user_$item[5]", $user);
        }
        $manager->flush();
    }

    private function createUser(
        string $firstName,
        string $lastName,
        string $middleName,
        string $email,
        int $status
    ): User {
        return (new User())
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setMiddleName($middleName)
            ->setEmail($email)
            ->setStatus($status);
    }

    private static function getInfo(): array
    {
        return [
            ['Григель', 'Валентин', 'Сергеевич', 'grig@mail.com', User::ACTIVE, 1],
            ['Роков', 'Максим', '', '@mail.com', User::ACTIVE, 2],
            ['Иванов', 'Иван', 'Иванович', 'ii@mail.com', User::ACTIVE, 3],
            ['Потапов', 'Потап', 'Потапович', 'pp@mail.com', User::ACTIVE, 4],
            ['Сидоров', 'Григорий', 'Павлович', 'gp@mail.com', User::ACTIVE, 5],
            ['Петров', 'Александр', 'Николаевич', 'an@mail.com', User::ACTIVE, 6],
            ['Узлов', 'Филлип', 'Владимирович', 'fv@mail.com', User::ACTIVE, 7],
            ['Козлов', 'Валерий', 'Константинович', 'vk@mail.com', User::ACTIVE, 8],
            ['Ветров', 'Сергей', 'Денисович', 'sd@mail.com', User::ACTIVE, 9],
            ['Сайков', 'Дмитрий', 'Стенович', 'ds@mail.com', User::ACTIVE, 10],
            ['Бойков', 'Михаил', 'Петрович', 'mp@mail.com', User::ACTIVE, 11],
            ['Линков', 'Михаил', 'Николаевич', 'mn@mail.com', User::ACTIVE, 12],
            ['Раков', 'Валерий', 'Петрович', 'vp@mail.com', User::ACTIVE, 13],
            ['Кличко', 'Михаил', 'Николаевич', 'kmn@mail.com', User::ACTIVE, 14],
            ['Виличко', 'Дмитрий', 'Сулейманович', 'vds@mail.com', User::ACTIVE, 15],
            ['Кач', 'Валерий', 'Денисович', 'kvd@mail.com', User::ACTIVE, 16],
            ['Калач', 'Сергей', 'Константинович', 'sk@mail.com', User::ACTIVE, 17],
            ['Ломач', 'Денис', 'Геннадьевич', 'dg@mail.com', User::DELETED, 18],
            ['Галюк', 'Дмитрий', 'Петрович', 'dp@mail.com', User::BLOCKED, 19],
            ['Валентинов', 'Сергей', 'Стенович', 'ss@mail.com', User::HALF_ACTIVE, 20],
        ];
    }
}
