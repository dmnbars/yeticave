<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lot;
use AppBundle\Form\LotType;
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
     * @Route("/lot/add", name="lot_add")
     */
    public function lotAddAction(Request $request)
    {
        $lot = new Lot();

        $form = $this->createForm(LotType::class, $lot);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lot->setUser($this->getUser());
            $lot->setDateCreate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($lot);
            $em->flush();

            return $this->redirect($this->generateUrl(
                'lot_detail'
            ));
        }

        return $this->render(
            'default/lot_add.html.twig',
            ['form' => $form->createView()]
        );
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
