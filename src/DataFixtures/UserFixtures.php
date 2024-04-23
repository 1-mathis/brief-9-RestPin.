<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\DataFixtures\AbstractFixtures;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends AbstractFixtures
{
  public function load(ObjectManager $manager)
  {
    for ($i = 0; $i < 10; $i++) {

      $user = new User();

      $user->setName($this->faker->name());
      $user->setEmail($this->faker->freeEmail());
      $user->setPassword($this->faker->password());
      $user->setUsername($this->faker->userName());
      $user->setSurname($this->faker->name());
      $user->setDescription($this->faker->word());
      $user->setUpdatedAt($this->faker->dateTime());
      $user->setCreatedAt($this->faker->dateTime());
      $user->setPassword(
        $this->passwordHasher->hashPassword($user, 'password ?')
      );

      $manager->persist($user);
    }
    $manager->flush();
  }
}
