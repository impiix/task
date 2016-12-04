<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPostData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 100; $i++) {
            $post = new Post("title" . $i, "content" . $i);
            $manager->persist($post);
        }
        $manager->flush();
    }
}
