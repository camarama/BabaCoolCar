<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Etape;
use App\Entity\Trajet;
use App\Entity\Vehicule;
use App\Form\RechercheTrajetType;
use App\Repository\AdresseRepository;
use App\Repository\EtapeRepository;
use App\Repository\VehiculeRepository;
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
    public function rechercheTrajet(EntityManagerInterface $em, Request $request)
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

        return $this->render('recherche/recherche_trajet.html.twig', [
            'adresse' => $adresse,
        ]);
    }

    /**
     * @Route("/traitement_recheche/{id}", name="traitement_recherche")
     */
    public function traitementRecherche($id, SessionInterface $session)
    {
        $trajet = $this->getDoctrine()->getRepository(Trajet::class)->findSelectedTrajet($id);

        if (!$trajet)
            throw $this->createNotFoundException('Le trajet n\'existe pas');

        $vehicule = $trajet->getVehicule();

        $etapes = $trajet->getEtapes();

        $session->set('trajet', $trajet);
        $session->set('vehicule', $vehicule);
        $session->set('etapes', $etapes);

        return $this->render('recherche/traitement_recherche.html.twig', [
            'trajet' => $trajet,
            'vehicule' => $vehicule,
            'etapes' => $etapes,
        ]);
    }
}
