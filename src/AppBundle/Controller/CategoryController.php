<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Lot;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CategoryController extends Controller
{
    /**
     * @Route("/category/{slug}", name="lot_category", requirements={"id" = "\d+"})
     * @ParamConverter("category", class="AppBundle:Category", options={"slug" = "slug"})
     *
     * @param Request $request
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, Category $category)
    {
        $lots = $this->getDoctrine()
            ->getRepository(Lot::class)
            ->findByCategory($category);

        return $this->render(
            'default/category.html.twig',
            [
                'category' => $category,
                'lots' => $lots,
            ]
        );
    }

    public function menuAction()
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();

        return $this->render('default/_category_menu.html.twig', ['categories' => $categories]);
    }
}
