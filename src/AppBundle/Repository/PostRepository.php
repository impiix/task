<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class PostRepository extends EntityRepository
{
    public function listAll(): Query
    {
        $qb = $this->createQueryBuilder("p")
            ->orderBy("p.created", "desc");

        return $qb->getQuery();
    }
}
