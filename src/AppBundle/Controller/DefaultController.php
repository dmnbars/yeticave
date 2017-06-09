<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lot;
use AppBundle\Form\LotType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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

        $lots = $this->getDoctrine()->getRepository('AppBundle:Lot')->findLatestOrderedByCreateDate();

        return $this->render(
            'default/index.html.twig',
            [
                'categories' => $categories,
                'lots' => $lots,
            ]
        );
    }

    /**
     * @Route("/lot/{id}", name="lot_detail", requirements={"id" = "\d+"})
     *
     * @param Request $request
     * @param Lot $lot
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function lotAction(Request $request, Lot $lot)
    {
        return $this->render('default/lot.html.twig', ['lot' => $lot]);
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/lot/add", name="lot_add")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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
                'lot_detail',
                ['id' => $lot->getId()]
            ));
        }

        return $this->render(
            'default/lot_add.html.twig',
            ['form' => $form->createView()]
        );
    }
}
