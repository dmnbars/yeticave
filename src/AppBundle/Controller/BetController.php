<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bet;
use AppBundle\Entity\Lot;
use AppBundle\Form\BetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BetController extends Controller
{
    public function listAction(Lot $lot)
    {
        $bets = $this->getDoctrine()
            ->getRepository(Bet::class)
            ->findByLotOrderedByCreateDate($lot);

        return $this->render('default/_bets_list.html.twig', ['bets' => $bets]);
    }

    /**
     * @Route("/bet/{lot_id}/add", name="bet_add", requirements={"lot_id" = "\d+"})
     * @Method("POST")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @ParamConverter("lot", options={"mapping": {"lot_id": "id"}})
     *
     * @param Request $request
     * @param Lot $lot
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request, Lot $lot)
    {
        $bet = new Bet();

        $form = $this->createForm(BetType::class, $bet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bet->setUser($this->getUser());
            $bet->setLot($lot);
            $bet->setCreatedDate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($bet);
            $em->flush();

            return $this->redirectToRoute(
                'lot_detail',
                ['id' => $lot->getId()]
            );
        }

        return $this->render(
            'default/_bet_form.html.twig',
            [
                'lot' => $lot,
                'form' => $form->createView(),
            ]
        );
    }

    public function formAction(Lot $lot)
    {
        $form = $this->createForm(BetType::class);

        return $this->render(
            'default/_bet_form.html.twig',
            [
                'lot' => $lot,
                'form' => $form->createView(),
            ]
        );
    }
}
