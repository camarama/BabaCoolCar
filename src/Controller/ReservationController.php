<?php

namespace App\Controller;

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
        $user = $this->getUser()->getId();

        if (!$session->has('reservation')) $session->set('reservation', array());
            $reservation = $session->get('reservation');

        if (array_key_exists($id, $reservation)){
            if ($request->query->get('place') != null) $reservation[$id] = $request->query->get('place');
        } else {
            if ($request->query->get('place') != null)
                $reservation[$id] = $request->query->get('place');
            else
                $reservation[$id] = 1;
        }

        $session->remove('trajet');
        $session->remove('vehicule');
        $session->remove('etapes');
        $session->set('reservation', $reservation);
        $session->set('user', $user);
        /*dump(array_keys($session->get('reservation')));
        dump($session);
        die();*/
        return $this->redirect($this->generateUrl('reservation'));
    }

    /**
     * @Route("ajout", name="reservation")
     */
    public function enregistrementTrajet(SessionInterface $session, EntityManagerInterface $em)
    {
        $user = $session->get('user');

        if (!$session->has('reservation')) $session->set('reservation', array());
        $trajet = $this->getDoctrine()->getRepository(Trajet::class)->findArray(array_keys($session->get('reservation')));

//        dump($trajet); die();
        $resa = new Reservation();
        $resa->setDateresa(new \DateTime('now'));
        $resa->setValideresa(1);
        $resa->setAnnuleresa(0);
        $resa->setTrajet($trajet);
        $resa->setMembre($user);
        $em->persist($resa);

        $em->flush();

        return $this->render('reservation/reservation.html.twig');
    }
}
