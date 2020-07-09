<?php

namespace GestionActiviteBundle\Controller;

use GestionActiviteBundle\Entity\Activite1;
use GestionActiviteBundle\Entity\ReservationActivite1;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;


/**
 * Reservationactivite1 controller.
 *
 * @Route("reservationactivite1")
 */
class ReservationActivite1Controller extends Controller
{
    /**
     * Lists all reservationActivite1 entities.
     *
     * @Route("/", name="reservationactivite1_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservationActivite1s = $em->getRepository('GestionActiviteBundle:ReservationActivite1')->findAll();

        return $this->render('@GestionActivite/reservation/index.html.twig', array(
            'reservationActivite1s' => $reservationActivite1s,
        ));
    }
    public function annonceAction(Request $request, $format)
    {
        $em = $this->getDoctrine()->getManager();

        $activite1s = $em->getRepository('GestionActiviteBundle:Activite1')->findByValider2();


        if($format=='json') {
            $encoders = array(new XmlEncoder(),new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());

            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($activite1s, 'json');

            return new Response($jsonContent);
        }

        return $this->render('@GestionActivite/reservation/index2.html.twig', array(
            'activite1s' => $activite1s,
        ));
    }
    public function afficheruneAction(Activite1 $activite1)
    {
        $deleteForm = $this->createDeleteForm($activite1);

        return $this->render('@GestionActivite/reservation/show2.html.twig', array(
            'activite1' => $activite1,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a new reservationActivite1 entity.
     *
     * @Route("/{idReservationa}/new", name="reservationactivite1_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,$idActivite,$format)
    {

        $em = $this->getDoctrine()->getManager();
        if($format=='json'){
            $data = (array)json_decode($request->getContent());
            $activite1 = $em->getRepository('GestionActiviteBundle:Activite1')->find($data["id_activite"]);
            $reservationActivite1 = new Reservationactivite1();
            $reservationActivite1->setIdagence($activite1->getIdagence());
            $reservationActivite1->setIdclient($data["id_user"]);
            $reservationActivite1->setIdActivite($activite1);
            $reservationActivite1->setPrix(($activite1->getPrix())*($data["nbredeplace"]));
            $reservationActivite1->setNbplace($data["nbredeplace"]);
            $activite1->setPlacedisponible(($activite1->getPlacedisponible())-($data["nbredeplace"]));
            $em->persist($reservationActivite1);
            $em->persist($activite1);
            $em->flush();
            return $this->redirectToRoute('Afficher_les_activite_a_reser');
        }
        $activite1 = $em->getRepository('GestionActiviteBundle:Activite1')->find($idActivite);

        $reservationActivite1 = new Reservationactivite1();
        $reservationActivite1->setIdagence($activite1->getIdagence());
        $reservationActivite1->setIdclient($this->getUser()->getId());
        $reservationActivite1->setIdActivite($activite1);
        $reservationActivite1->setPrix(($activite1->getPrix())*($reservationActivite1->getNbplace()));
        $form = $this->createForm('GestionActiviteBundle\Form\ReservationActivite1Type', $reservationActivite1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservationActivite1);
            $em->flush();
            $reservationActivite1->setPrix(($activite1->getPrix())*($reservationActivite1->getNbplace()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservationActivite1);
            $em->flush();
            $activite1->setPlacedisponible(($activite1->getPlacedisponible())-($reservationActivite1->getNbplace()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($activite1);
            $em->flush();
            return $this->redirectToRoute('afficher_une_reservation', array('idReservationa' => $reservationActivite1->getIdreservationa()));
        }

        return $this->render('@GestionActivite/reservation/new.html.twig', array(
            'reservationActivite1' => $reservationActivite1,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservationActivite1 entity.
     *
     * @Route("/{idReservationa}", name="reservationactivite1_show")
     * @Method("GET")
     */
    public function showAction(ReservationActivite1 $reservationActivite1)
    {
        $deleteForm = $this->createDeleteForm($reservationActivite1);

        return $this->render('@GestionActivite/reservation/show.html.twig', array(
            'reservationActivite1' => $reservationActivite1,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservationActivite1 entity.
     *
     * @Route("/{idReservationa}/edit", name="reservationactivite1_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ReservationActivite1 $reservationActivite1)
    {
        $deleteForm = $this->createDeleteForm($reservationActivite1);
        $editForm = $this->createForm('GestionActiviteBundle\Form\ReservationActivite1Type', $reservationActivite1);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('moidifier_reservation_act', array('idReservationa' => $reservationActivite1->getIdreservationa()));
        }

        return $this->render('@GestionActivite/reservation/edit.html.twig', array(
            'reservationActivite1' => $reservationActivite1,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservationActivite1 entity.
     *
     * @Route("/{idReservationa}", name="reservationactivite1_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ReservationActivite1 $reservationActivite1)
    {
        $form = $this->createDeleteForm($reservationActivite1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservationActivite1);
            $em->flush();
        }

        return $this->redirectToRoute('Afficher_les_reservation_act');
    }

    /**
     * Creates a form to delete a reservationActivite1 entity.
     *
     * @param ReservationActivite1 $reservationActivite1 The reservationActivite1 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReservationActivite1 $reservationActivite1)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('supprimer_reservation_act', array('idReservationa' => $reservationActivite1->getIdreservationa())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
