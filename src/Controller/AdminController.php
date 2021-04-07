<?php

declare(strict_types=1);

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

/**
 * Class AdminController.
 */
class AdminController extends EasyAdminController
{
    /**
     * @return mixed
     */
    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    /**
     * @param $user
     */
    public function persistUserEntity($user): void
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);

        parent::persistEntity($user);
    }

    /**
     * @param $user
     */
    public function updateUserEntity($user): void
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }
}
