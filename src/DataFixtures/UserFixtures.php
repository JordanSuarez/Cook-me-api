<?php


namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
     private UserPasswordEncoderInterface $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $user = new User("admin");
        $user->setPassword($this->passwordEncoder->encodePassword($user, '12345678'));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();
    }
}