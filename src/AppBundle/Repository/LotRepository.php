<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

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

    public function queryByCategory(Category $category)
    {
        return $this->createQueryBuilder('lot')
            ->where('lot.category = :category')
            ->setParameter('category', $category);
    }

    public function findByCategory(Category $category, $page = 1)
    {
        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($this->queryByCategory($category), false));
        $pagerfanta->setMaxPerPage(Category::NUM_ITEMS);
        $pagerfanta->setCurrentPage($page);

        return $pagerfanta;
    }
}
