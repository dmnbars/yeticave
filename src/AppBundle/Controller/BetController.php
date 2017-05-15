<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BetController extends Controller
{
    public function listAction(Lot $lot)
    {
        $bets = $this->getDoctrine()
            ->getRepository('AppBundle:Bet')->findByLotOrderedByCreateDate($lot);

        return $this->render('default/_bets_list.html.twig', ['bets' => $bets]);
    }
}
