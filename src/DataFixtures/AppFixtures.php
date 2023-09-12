<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{


    public function __construct(
        Private UserPasswordHasherInterface $passwordHasher
    )
        {
            $this->faker = Factory::create();
        }

    public function load(ObjectManager $manager): void
    {



        $user = new User();
        $user->setEmail('lucaspaivadev@gmail.com');
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $manager->persist($user);

        $plaintextPassword = 'password';

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        for($i=0;$i<3;$i++){
            $user = new User();
            $user->setEmail($this->faker->email());
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);

            $plaintextPassword = uniqid();

            // hash the password (based on the security.yaml config for the $user class)
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
        }

        $manager->flush();
    }
}
