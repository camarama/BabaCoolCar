<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Entity\Reservation;
use App\Entity\Trajet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationController extends Controller
{
    /**
     * @Route("/reservation/{id}", name="traitementReservation")
     */
    public function reservationTrajet($id, SessionInterface $session, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        if (!$session->has('trajet')) $session->set('trajet', array());
            $trajet = $session->get('trajet');

        $trajetArray = (array) $trajet;

        if (array_key_exists($id, $trajetArray)){
            if ($request->query->get('place') != null) $trajetArray[$id] = $request->query->get('place');
        } else {
            if ($request->query->get('place') != null)
                $trajetArray[$id] = $request->query->get('place');
            else
                $trajetArray[$id] = 1;
        }

        $session->set('place', $trajetArray[$id]);
        $session->set('user', $user);
        
        return $this->redirect($this->generateUrl('reservation'));
    }

    /**
     * @Route("ajout", name="reservation")
     */
    public function enregistrementTrajet(SessionInterface $session, EntityManagerInterface $em)
    {
        $user = $session->get('user');
        $trajetR = $session->get('trajet');

        $membre = $this->getDoctrine()->getRepository(Membre::class)->find($user);
        $trajet = $this->getDoctrine()->getRepository(Trajet::class)->find($trajetR);

        $resa = new Reservation();
        $resa->setDateresa(new \DateTime('now'));
        $resa->setValideresa(1);
        $resa->setAnnuleresa(0);
        $resa->setTrajet($trajet);
        $resa->setMembre($membre);
        $em->persist($resa);

        $em->flush();

        return $this->render('reservation/reservation.html.twig');
    }
}
