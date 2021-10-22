<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $admin = new User;
        $hash = $this->encoder->encodePassword($admin, "password");
        $admin->setEmail("olivier.jouan@dyadem.fr")
            ->setPassword($hash)
            ->setFullName("Olivier Jouan")
            ->setRoles(['ROLE_ADMIN']);
        // $product = new Product();
        // $manager->persist($product);
        $manager->persist($admin);
        $manager->flush();
    }
}
