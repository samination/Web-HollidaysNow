<?php

namespace RestaurationBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use RestaurationBundle\Entity\Resrevations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RestaurationBundle\Form\rechercheRestaurantsForm;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ReservationsController extends Controller
{
    public function afficherReservationAction()
    {
        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository("RestaurationBundle:Resrevations")->findAll();
        return $this->render('@RestaurationBundle/Reservations/afficher_reservation.html.twig', array("reservations"=>$reservation));
    }
    public function ajouterReservationAction(Request $request,$id)
    {
        $reservation=new Resrevations();


        if ($request->isMethod('POST')) {

            $reservation->setNbPersonnes($request->get('nb_place'));
            $reservation->setDateRes($request->get('date_reservation'));
            $reservation->setIdResto($id);
            $reservation->setIdAgence($this->getUser());
            $em=$this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('afficher');

        }
        return $this->render('@Restauration/Reservations/ajouter_reservation.html.twig');

    }

    public function supprimerReservationAction()
    {
        return $this->render('RestaurationBundle:Reservations:supprimer_reservation.html.twig', array(
            // ...
        ));
    }

}
