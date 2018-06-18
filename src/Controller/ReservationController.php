<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Trajet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationController extends Controller
{
    /**
     * @Route("/reservation/{id}", name="reservation")
     */
    public function reservationTrajet(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();

        $vehicule = $session->get('vehicule');
        $etapes = $session->get('etapes');
        $trajet = $session->get('trajet');


//        dump($trajet); die();
        $resa = new Reservation();
        $resa->setMembre($user);
        $resa->setTrajet($trajet);
        $resa->setDateresa(new \DateTime("now"));
        $resa->setValideresa(1);
        $resa->setAnnuleresa(0);
        $em->persist($resa);
       /* $em->persist($etapes);
        $em->persist($trajet);*/

        $em->flush();

        return $this->render('reservation/reservation.html.twig', [
            'trajet' => $trajet,
            'vehicule' => $vehicule,
            'etapes' => $etapes,
            ]);
    }
}
