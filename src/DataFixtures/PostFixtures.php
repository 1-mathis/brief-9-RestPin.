<?php

namespace App\DataFixtures;

use App\DataFixtures\AbstractFixtures;
use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends AbstractFixtures
{
  public function load(ObjectManager $manager)
  {
    for ($i = 0; $i < 10; $i++) {

      $post = new Post();

      $post->setBody($this->faker->word());
      $post->setDescription($this->faker->word());
      $post->setUpdatedAt($this->faker->dateTime());
      $post->setCreatedAt($this->faker->dateTime());
      $post->setAuthor($this->faker->integer);


      $manager->persist($post);
    }
    $manager->flush();
  }
}
