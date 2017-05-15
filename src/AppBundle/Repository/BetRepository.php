<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Lot;
use Doctrine\ORM\EntityRepository;

class BetRepository extends EntityRepository
{
    public function findByLotOrderedByCreateDate(Lot $lot)
    {
        return $this->getEntityManager()
            ->createQuery(
            'SELECT b 
                  FROM AppBundle:Bet b 
                  WHERE b.lot = :lot 
                  ORDER BY b.dateCreate DESC'
            )
            ->setParameter('lot', $lot)
            ->getResult();
    }
}
