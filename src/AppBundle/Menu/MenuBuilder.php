<?php
namespace AppBundle\Menu;

use Doctrine\ORM\EntityManager;
use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;
    private $em;

    public function __construct(FactoryInterface $factory, EntityManager $em)
    {
        $this->factory = $factory;
        $this->em = $em;
    }

    public function createCatalogMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $categories = $this->em->getRepository('AppBundle:Category')->findAll();

        foreach ($categories as $category) {
            $menu->addChild(
                $category->getName(),
                [
                    'route' => 'lot_category',
                    'routeParameters' => ['slug' => $category->getSlug()],
                ]
            )->setAttributes(['slug' => $category->getSlug()]);
        }

        return $menu;
    }
}
