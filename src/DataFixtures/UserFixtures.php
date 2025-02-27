<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        // $manager->persist($product);
        $user->setPassword($this->passwordEncoder->encodePassword( $user, 'the_new_password'));
        $manager->flush();
    }
}
