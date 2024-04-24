<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
  public function __construct(private readonly UserPasswordHasherInterface $hasher)
  {
  }
  public function load(ObjectManager $manager)
  {
    $faker = Factory::create('fr_FR');
    for ($i = 1; $i < 10; $i++) {

      $user = new User();

      $user
        ->setName($faker->name())
        ->setEmail($faker->freeEmail())
        ->setUsername($faker->userName())
        ->setSurname($faker->name())
        ->setDescription($faker->word())
        ->setUpdatedAt($faker->dateTime())
        ->setCreatedAt($faker->dateTime())
        ->setPassword(
          $this->hasher->hashPassword($user, $faker->password())
        );

      $manager->persist($user);

      $this->addReference('user' . $i, $user);
    }
    $manager->flush();
  }
}
