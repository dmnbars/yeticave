<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();

        return $this->render(
            'default/index.html.twig',
            ['categories' => $categories]
        );
    }

    /**
     * @Route("/lot", name="lot_detail")
     */
    public function lotAction(Request $request)
    {
        return $this->render('default/lot.html.twig');
    }

    /**
     * @Route("/category", name="lot_category")
     */
    public function categoryAction(Request $request)
    {
        return $this->render('default/category.html.twig');
    }

    public function categoryMenuAction()
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();

        return $this->render('default/_category_menu.html.twig', ['categories' => $categories]);
    }
}
