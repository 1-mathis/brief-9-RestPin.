<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $faker = Factory::create('fr_FR');
    for ($i = 1; $i < 10; $i++) {

      $post = new Post();

      $post
        ->setBody($faker->word())
        ->setDescription($faker->paragraph(1))
        ->setUpdatedAt($faker->DateTime())
        ->setCreatedAt($faker->DateTime())
        ->setAuthor($this->getReference('user' . $i));

      $manager->persist($post);
    }
    $manager->flush();
  }

  public function getDependencies()
  {
    return [UserFixtures::class];
  }
}
