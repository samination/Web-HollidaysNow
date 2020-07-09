<?php

namespace DaysBundle\Controller;

use DaysBundle\Entity\Reservationvol;
use DaysBundle\Entity\Vols;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;

/**
 * Reservationvol controller.
 *
 * @Route("reservationvol")
 */
class ReservationvolController extends Controller
{
    /**
     * Lists all reservationvol entities.
     *
     * @Route("/", name="reservationvol_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservationvols = $em->getRepository('DaysBundle:Reservationvol')->findAll();

        return $this->render('reservationvol/index1.html.twig', array(
            'reservationvols' => $reservationvols,
        ));
    }


    public function annonceAction($format)
    {
        $em = $this->getDoctrine()->getManager();

        $vols = $em->getRepository('DaysBundle:Vols')->findAll();
        if($format=='json') {
            $encoders = array(new XmlEncoder(),new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());

            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($vols, 'json');

            return new Response($jsonContent);
        }
        return $this->render('@Days/Reservationvol/index1.html.twig', array(
            'vols' => $vols,
        ));
    }



    public function annonce2Action()
    {
        $em = $this->getDoctrine()->getManager();

        $vols = $em->getRepository('DaysBundle:Vols')->findAll();

        return $this->render('@Days/Reservationvol/index2.html.twig', array(
            'vols' => $vols,
        ));
    }


    public function annonce3Action()
    {
        $em = $this->getDoctrine()->getManager();

        $vols = $em->getRepository('DaysBundle:Vols')->findAll();

        return $this->render('@Days/Reservationvol/index3.html.twig', array(
            'vols' => $vols,
        ));
    }



    /**
     * Creates a new reservationvol entity.
     *
     * @Route("/new", name="reservationvol_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,$idVol,$format)
    {


        $em = $this->getDoctrine()->getManager();
        if($format=='json'){
            $data = (array)json_decode($request->getContent());
            $Vol = $em->getRepository('DaysBundle:Vols')->find($data["id_vol"]);
            $reservationvol = new Reservationvol();
            $reservationvol->setIdagence($Vol->getIdAgence());
            $reservationvol->setIdclient($data["id_user"]);
            $reservationvol->setIdVol($Vol);
            $reservationvol->setPrix(($Vol->getPrix())*(($data["nbredeplace"])));
            $reservationvol->setNbplace($data["nbredeplace"]);
            $Vol->setNbPlaces(($Vol->getNbPlaces())-($data["nbredeplace"]));
            $em->persist($reservationvol);
            $em->persist($Vol);
            $em->flush();
            return $this->redirectToRoute('affiche_vol');

        }


        $Vol = $em->getRepository('DaysBundle:Vols')->find($idVol);

        $reservationvol = new Reservationvol();
        $reservationvol->setIdagence($Vol->getIdAgence());
        $reservationvol->setIdclient($this->getUser()->getId());
        $reservationvol->setIdVol($Vol);
        $reservationvol->setPrix(($Vol->getPrix())*($reservationvol->getNbplace()));
        $form = $this->createForm('DaysBundle\Form\ReservationvolType', $reservationvol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservationvol);
            $em->flush();
            $reservationvol->setPrix(($Vol->getPrix())*($reservationvol->getNbplace()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservationvol);
            $em->flush();
            $Vol->setNbPlaces(($Vol->getNbPlaces())-($reservationvol->getNbplace()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($Vol);
            $em->flush();

            return $this->redirectToRoute('affiche_vol', array('idReservation' => $reservationvol->getIdreservation()));
        }

        return $this->render('@Days/Reservationvol/new.html.twig', array(
            'reservationvol' => $reservationvol,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservationvol entity.
     *
     * @Route("/{idReservation}", name="reservationvol_show")
     * @Method("GET")
     */
    public function showAction(Reservationvol $reservationvol)
    {
        $deleteForm = $this->createDeleteForm($reservationvol);

        return $this->render('reservationvol/show.html.twig', array(
            'reservationvol' => $reservationvol,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservationvol entity.
     *
     * @Route("/{idReservation}/edit", name="reservationvol_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reservationvol $reservationvol)
    {
        $deleteForm = $this->createDeleteForm($reservationvol);
        $editForm = $this->createForm('DaysBundle\Form\ReservationvolType', $reservationvol);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservationvol_edit', array('idReservation' => $reservationvol->getIdreservation()));
        }

        return $this->render('reservationvol/edit.html.twig', array(
            'reservationvol' => $reservationvol,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservationvol entity.
     *
     * @Route("/{idReservation}", name="reservationvol_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reservationvol $reservationvol)
    {
        $form = $this->createDeleteForm($reservationvol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservationvol);
            $em->flush();
        }

        return $this->redirectToRoute('reservationvol_index');
    }

    /**
     * Creates a form to delete a reservationvol entity.
     *
     * @param Reservationvol $reservationvol The reservationvol entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reservationvol $reservationvol)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservationvol_delete', array('idReservation' => $reservationvol->getIdreservation())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
