<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LotRepository extends EntityRepository
{
    public function findLatestOrderedByCreateDate()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT l FROM AppBundle:Lot l ORDER BY l.dateCreate DESC'
            )
            ->setMaxResults(6)
            ->getResult();
    }
}
