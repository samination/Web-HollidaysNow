<?php

namespace VoyageOrganiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use VoyageOrganiseBundle\Entity\Reservervoyageorganise;
use VoyageOrganiseBundle\Entity\Voyageorganise;
use VoyageOrganiseBundle\VoyageOrganiseBundle;


class ReserverVoyageOrganiseController extends Controller
{

    public function AjouterReservationVoyageorgAction($id, Request $request)
    {
        $idu = $this->getUser()->getId();
        $reservation = new Reservervoyageorganise();
        $form = $this->createForm('VoyageOrganiseBundle\Form\ReservervoyageorganiseType', $reservation);
        $form->handleRequest($request);
        $reservation->setIdUser($idu);
        $em=$this->getDoctrine()->getManager();
        $voyage=$em->getRepository(Voyageorganise::class)->find($id);


        //$voyage=$em->getRepository('VoyageOrganiseBundle:Voyageorganise')->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
           if($voyage->getNbPlaces()>= $reservation->getNbrplace()){
                $em = $this->getDoctrine()->getManager();
                $reservation->setIdVoyageorganise($voyage);
               $reservation->setIdAgence($voyage->getIdAgence());
                 $reservation->setPrix($voyage->getPrixVoyage()*$reservation->getNbrplace());}
            $voyage->setNbPlaces($voyage->getNbPlaces()-$reservation->getNbrplace());
            $em->persist($reservation);
            $em->flush();
          $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')->setUsername('arijmediouni@gmail.com')->setPassword('azertyazerty123');

            $mailer = \Swift_Mailer::newInstance($transport);

            $message = \Swift_Message::newInstance('cc ')
                ->setFrom(array("arijmediouni@gmail.com" => "Holidays now"))
                ->setTo(array("abderrahmen.elhadjsalah@esprit.tn" => "abderrahmen.elhadjsalah@esprit.tn"))
                ->setBody(" <h1> Votre reservation est effectueée avec succés!!! </h1> ", 'text');


          $mailer->send($message);
            $em2 = $this->getDoctrine()->getManager();
            $em2->merge($reservation);

            $em2->flush();
            $this->get('session')
                ->getFlashBag()
                ->add('info', 'Réservation Effectué! !');
            return $this->redirectToRoute('reservvoyageorg_affiche');
            // return $this->redirectToRoute('reservationhebergement_show', array('id' => $reservation->getIdreservationh()));
            //     return $this->redirectToRoute('reservation_show', array('id' => $reservation->getId()));
        }

        return $this->render('@VoyageOrganise/VoyageOrganise/reserverVoyageorg.html.twig"', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
        ));

    }

    public function affResAction()
    {
        /*$user = $this->getUser() ;
        if (!$user){
            return $this->redirectToRoute('fos_user_security_login') ;
        }
        $user = $this->getUser();*/




        $res= $this->getDoctrine()->getRepository('VoyageOrganiseBundle:Reservervoyageorganise')->findAll();
        return $this->render("@VoyageOrganise/VoyageOrganise/mesreservations.html.twig",array('reservation'=>$res));
    }
    public function AnnulerResAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $reservation=$em->getRepository(Reservervoyageorganise::class)->find($id);

        $voyage = $em->getRepository(Voyageorganise::class)->find($reservation->getIdVoyageorganise());
        $reservation->setIdVoyageorganise($voyage);
        $voyage->setNbPlaces($voyage->getNbPlaces()+$reservation->getNbrplace()) ;
        $em->remove($reservation);
        $em->flush();
        $this->get('session')
            ->getFlashBag()
            ->add('info', 'Annulation Effectué!');
        return $this->redirectToRoute('reservvoyageorg_affiche');
    }
}
