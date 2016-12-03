<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Post
 * @package AppBundle\Entity
 * @ORM\Entity
 */
class Post
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $title;

    protected $content;

    protected $created;

    public function __construct()
    {
        $this->created = new \DateTime();
    }
}
