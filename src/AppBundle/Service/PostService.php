<?php

namespace AppBundle\Service;

use AppBundle\Entity\Post;
use Doctrine\ORM\EntityManager;

class PostService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * PostService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Post $post
     */
    public function save(Post $post)
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }
}
