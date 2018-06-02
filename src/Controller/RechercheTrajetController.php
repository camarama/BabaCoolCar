<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Etape;
use App\Entity\Trajet;
use App\Entity\Vehicule;
use App\Form\RechercheTrajetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RechercheTrajetController extends Controller
{
    public function formulaireRecherche()
    {
        $form = $this->createForm(RechercheTrajetType::class);

        return $this->render('recherche/modules/formulaire_recherche.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/recherche_trajet", name="recherche-trajet")
     */
    public function rechercheTrajet(EntityManagerInterface $em, Request $request, SessionInterface $session)
    {
        $form = $this->createForm(RechercheTrajetType::class);

        if ($request->isMethod('POST')){

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){

                $recherche1 = $form->get('depart')->getData();
                $recherche2 = $form->get('destination')->getData();

                $adresse = $em->getRepository(Adresse::class)->rechercheTrajet($recherche1, $recherche2);
            }
        }

        $session->set('adresse', $adresse);

        return $this->render('recherche/recherche_trajet.html.twig', [
            'adresse' => $adresse,
        ]);
    }

    /**
     * @Route("/traitement_recheche/{id}", name="traitement_recherche")
     */
    public function traitementRecherche($id, Request $request, SessionInterface $session, EntityManagerInterface $em)
    {
        $trajet = $em->getRepository(Trajet::class)->find($id);

        if (!$trajet)
            throw $this->createNotFoundException('Le trajet n\'existe pas');

        return $this->render('recherche/traitement_recherche.html.twig', [
            'trajet' => $trajet,
        ]);
    }
}

/*
if ($request->isMethod('POST'))
{
    $form->handleRequest($request);

    if ($form->isValid() && $form->isSubmitted())
    {
        $recherche1 = $form->get('depart')->getData();
        $recherche2 = $form->get('destination')->getData();

        $adresses = $em->getRepository(Adresse::class)->rechercheTrajet($recherche1, $recherche2);

        if (!$adresses)
            throw $this->createNotFoundException('pas de trajet dispo !!!');
    }

--------------------------------------------------------------------------------------------------------------------------

if (!$session->has('trajet')) $session->set('trajet', $trajet);

        $trajet = $em->getRepository(Trajet::class)->find($id);

//        dump($trajet); die();

        $vehicule = $em->getRepository(Vehicule::class);
//        dump($session->get('trajet')); die();

        /*if ()) {

        }
        else
            throw $this->createNotFoundException('la page n\'existe pas');*/

//        dump($trajet); die();

/*if (array_key_exists($id, $trajet))
    $session->set('trajet', $trajet);
else
    throw $this->createNotFoundException('la page est introuvable');*/


/* if ($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {

     return $this->redirectToRoute('fos_user_security_login');
 } else {
     $resa = new Reservation();
     $resa->setTrajet($trajet);
     $resa->setMembre($this->getUser());
     $resa->setDateresa(new \DateTime('now'));
     $resa->setAnnuleresa(0);
     $resa->setValideresa(1);
     $em->persist($resa);

     $em->flush();
 }

 $session->set('resa',$resa);*/

//        dump($trajet); die();
