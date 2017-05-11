<?php
/**
 * Created by PhpStorm.
 * User: dmnbars
 * Date: 11/05/2017
 * Time: 21:41
 */

namespace AppBundle\Security\User;

use FOS\UserBundle\Security\UserProvider;

class EmailUserProvider extends UserProvider
{
    /**
     * {@inheritdoc}
     */
    protected function findUser($username)
    {
        return $this->userManager->findUserByEmail($username);
    }
}
