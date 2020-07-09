<?php

namespace DaysBundle\Controller;

use DaysBundle\Entity\Vols;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DateTimeParamConverter;
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
 * Vol controller.
 *
 * @Route("vols")
 */
class VolsController extends Controller
{
    /**
     * Lists all vol entities.
     *
     * @Route("/", name="vols_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vols = $em->getRepository('DaysBundle:Vols')->findAll();

        return $this->render('@Days/vols/index.html.twig', array(
            'vols' => $vols,
        ));
    }



    public function index2Action()
    {
        $em = $this->getDoctrine()->getManager();

        $vols = $em->getRepository('DaysBundle:Vols')->findAll();

        return $this->render('@Days/vols/index2.html.twig', array(
            'vols' => $vols,
        ));
    }


    public function index3Action()
    {
        $em = $this->getDoctrine()->getManager();

        $vols = $em->getRepository('DaysBundle:Vols')->findAll();

        return $this->render('@Days/vols/index3.html.twig', array(
            'vols' => $vols,
        ));
    }



    public function afficherparidagenceAction($format,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if($format=='json') {
            $data = (array)json_decode($request->getContent());
            $vols = $em->getRepository('DaysBundle:Vols')->findById_agence($data["id"]);
            $encoders = array(new XmlEncoder(),new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());

            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($vols, 'json');

            return new Response($jsonContent);
        }
        $vols = $em->getRepository('DaysBundle:Vols')->findById_agence($this->getUser()->getId());

        return $this->render('@Days/vols/index4.html.twig', array(
            'vols' => $vols,
        ));
    }


    /**
     * Creates a new vol entity.
     *
     * @Route("/new", name="vols_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,$format)
    {
        $vol = new Vols();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('DaysBundle\Form\VolsType', $vol);
        $form->handleRequest($request);
        if($format=='json'){
            $data = (array)json_decode($request->getContent());
            $vol->setIdagence($data["id_agence"]);
            $vol->setVilleDepart($data["ville_depart"]);
            $vol->setDescription($data["description"]);
            $vol->setNbPlaces($data["placedisp"]);
            $vol->setVilleArrive($data["ville_arrive"]);
            $vol->setType($data["type_vol"]);
            $vol->setPrix($data["prix"]);

            $vol->setDateDepart (new \DateTime($data["date_depart"]));
            $vol->setDateArrive(new \DateTime($data["date_arrive"]));
            $em->persist($vol);
            $em->flush();
        } else {

            if ($form->isSubmitted() && $form->isValid()) {
                $vol->setIdagence($this->getUser()->getId());
                $em->persist($vol);
                $em->flush();

                return $this->redirectToRoute('afficher_par_id_vol');
            }
        }
        return $this->render('@Days/vols/new.html.twig', array(
            'vol' => $vol,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vol entity.
     *
     * @Route("/{id}", name="vols_show")
     * @Method("GET")
     */
    public function showAction(Vols $vol)
    {
      //  $deleteForm = $this->createDeleteForm($vol);

        return $this->render('@Days/vols/show.html.twig', array(
            'vol' => $vol,
        ));

// From your controller or service
$data = array(
    'my-message' => "My custom message",
);
$pusher = $this->get('mrad.pusher.notificaitons');
$pusher->trigger($data);


    }

    /**
     * Displays a form to edit an existing vol entity.
     *
     * @Route("/{id}/edit", name="vols_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Vols $vol,$format)
    {
        $editForm = $this->createForm('DaysBundle\Form\VolsType', $vol);
        $editForm->handleRequest($request);
        if($format=='json'){
            $data = (array)json_decode($request->getContent());
            $em=$this->getDoctrine()->getManager();
            $vol = $em->getRepository(Vols::class)->find($data["id_vol"]);
            $vol->setIdagence($data["id_agence"]);
            $vol->setVilleDepart($data["ville_depart"]);
            $vol->setDescription($data["description"]);
            $vol->setNbPlaces($data["placedisp"]);
            $vol->setVilleArrive($data["ville_arrive"]);
            $vol->setType($data["type_vol"]);
            $vol->setPrix($data["prix"]);

            $vol->setDateDepart (new \DateTime($data["date_depart"]));
            $vol->setDateArrive(new \DateTime($data["date_arrive"]));
            $em->persist($vol);
            $em->flush();
        } else {
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('afficher_par_id_vol', array('idVol' => $vol->getIdvol()));
            }
        }
        return $this->render('@Days/vols/edit.html.twig', array(
            'vol' => $vol,
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a vol entity.
     *
     * @Route("/{idVol}", name="vols_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Vols $vol,$format)
    {
        if($format=='json'){
            $data = (array)json_decode($request->getContent());
            $em=$this->getDoctrine()->getManager();
            $vol = $em->getRepository(Vols::class)->find($data["id_vol"]);
            $em->remove($vol);
            $em->flush();
            return $this->redirectToRoute('affiche_vol');
        }
    }

    /**
     * Creates a form to delete a vol entity.
     *
     * @param Vols $vol The vol entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Vols $vol)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('supprimer_Vol', array('idVol' => $vol->getIdvol())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    public function supprimerAction($id)
    {
        //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $modele= $em->getRepository(Vols::class)->find($id);
        //remove from the ORM
        $em->remove($modele);
        //update the data base!
        $em->flush();
        return $this->redirectToRoute('afficher_par_id_vol');
    }


}
