<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private const DEFAULT_PASSWORD = 'colipays';

    /**
     * @var UserPasswordHasherInterface $passwordHasher
     */
    private $passwordHasher;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * UserFixtures constructor.
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        // Generate "login" user
        $user = new User();
        $user->setEmail('test@colipays.com')
            ->setFirstname('test')
            ->setLastname('colipays')
            ->setPassword($this->passwordHasher->hashPassword($user, self::DEFAULT_PASSWORD))
        ;
        $manager->persist($user);

        // Generate 99 random users for display
        for ($i = 0;$i < 99; $i++) {
            $user = $this->generateUser();

            $manager->persist($user);

            if ($i % 25 === 0) {
                $manager->flush();
            }
        }

        $manager->flush();
    }

    /**
     * Generate a random User Entity
     *
     * @return User
     */
    protected function generateUser()
    {
        $user   = new User();

        $user->setEmail($this->faker->email)
            ->setFirstname($this->faker->firstName)
            ->setLastname($this->faker->lastName)
            ->setPassword($this->passwordHasher->hashPassword($user, self::DEFAULT_PASSWORD));

        return $user;
    }
}
