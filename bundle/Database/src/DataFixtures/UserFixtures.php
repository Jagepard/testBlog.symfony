<?php

namespace Bundle\Database\DataFixtures;

use Bundle\Database\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setPassword('$2y$13$S1LtONYVCnEXa1ZLIyKXPe4UYQKlqzm1mAYJD/Hiiu7ERcw9R6soy');
        $user->setRoles(["ROLE_ADMIN"]);

        $manager->persist($user);
        $manager->flush();
    }
}
