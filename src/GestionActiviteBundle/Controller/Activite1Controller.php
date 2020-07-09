<?php

namespace GestionActiviteBundle\Controller;

use GestionActiviteBundle\Entity\Activite1;
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
 * Activite1 controller.
 *
 * @Route("activite1")
 */
class Activite1Controller extends Controller
{
    /**
     * Lists all activite1 entities.
     *
     * @Route("/", name="activite1_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $activite1s = $em->getRepository('GestionActiviteBundle:Activite1')->findAll();

        return $this->render('@GestionActivite/activites/index.html.twig', array(
            'activite1s' => $activite1s,
        ));
    }



    public function index3Action()
    {
        $em = $this->getDoctrine()->getManager();

        $activite1s = $em->getRepository('GestionActiviteBundle:Activite1')->findByValider();

        return $this->render('@GestionActivite/activites/index3.html.twig', array(
            'activite1s' => $activite1s,
        ));



    }
    public function afficherparidagenceAction(Request $request,$format)
    {
        $em = $this->getDoctrine()->getManager();





        if($format=='json') {
            $data = (array)json_decode($request->getContent());
            $activite1s = $em->getRepository('GestionActiviteBundle:Activite1')->findByIdagence($data["id"]);
            $encoders = array(new XmlEncoder(),new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());

            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($activite1s, 'json');

            return new Response($jsonContent);
        }
        $activite1s = $em->getRepository('GestionActiviteBundle:Activite1')->findByIdagence($this->getUser()->getId());
        return $this->render('@GestionActivite/activites/index2.html.twig', array(
            'activite1s' => $activite1s,
        ));
    }
    /**
     * Creates a new activite1 entity.
     *
     * @Route("/new", name="activite1_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $format)
    {

        $activite1 = new Activite1();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('GestionActiviteBundle\Form\Activite1Type', $activite1);
        $form->handleRequest($request);

        if($format=='json'){
            $data = (array)json_decode($request->getContent());
            $activite1->setIdagence($data["idAgence"]);
            $activite1->setNom($data["nom"]);
            $activite1->setAdresse($data["adresse"]);
            $activite1->setDescription($data["description"]);
            $activite1->setPays($data["pays"]);
            $activite1->setPlacedisponible($data["placedisponible"]);
            $activite1->setRegion($data["region"]);
            $activite1->setType($data["type"]);
            $activite1->setPrix($data["prix"]);
            $em->persist($activite1);
            $em->flush();
        } else{

            if ($form->isSubmitted() && $form->isValid()) {
                $activite1->setIdagence($this->getUser()->getId());

                $em->persist($activite1);
                $em->flush();

                return $this->redirectToRoute('afficher_activite', array('idActivite' => $activite1->getIdactivite()));
            }

        }

        return $this->render('@GestionActivite/activites/new.html.twig', array(
            'activite1' => $activite1,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a activite1 entity.
     *
     * @Route("/{idActivite}", name="activite1_show")
     * @Method("GET")
     */
    public function showAction(Activite1 $activite1)
    {
        $deleteForm = $this->createDeleteForm($activite1);

        return $this->render('@GestionActivite/activites/show.html.twig', array(
            'activite1' => $activite1,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function show2Action(Activite1 $activite1)
    {
        $deleteForm = $this->createDeleteForm($activite1);

        return $this->render('@GestionActivite/activites/show2.html.twig', array(
            'activite1' => $activite1,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing activite1 entity.
     *
     * @Route("/{idActivite}/edit", name="activite1_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Activite1 $activite1, $format)
    {

        $deleteForm = $this->createDeleteForm($activite1);
        $editForm = $this->createForm('GestionActiviteBundle\Form\Activite1Type', $activite1);
        $editForm->handleRequest($request);
        if($format=='json'){
            $data = (array)json_decode($request->getContent());
            $em=$this->getDoctrine()->getManager();
            $activite1 = $em->getRepository(Activite1::class)->find($data["id"]);
            $activite1->setIdagence($data["idAgence"]);
            $activite1->setNom($data["nom"]);
            $activite1->setAdresse($data["adresse"]);
            $activite1->setDescription($data["description"]);
            $activite1->setPays($data["pays"]);
            $activite1->setPlacedisponible($data["placedisponible"]);
            $activite1->setRegion($data["region"]);
            $activite1->setType($data["type"]);
            $activite1->setPrix($data["prix"]);
            $em->persist($activite1);
            $em->flush();
        } else {
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('afficher_par_id', array('idActivite' => $activite1->getIdactivite()));
            }
        }

        return $this->render('@GestionActivite/activites/edit.html.twig', array(
            'activite1' => $activite1,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }





    public function validerAction(Request $request, Activite1 $activite1)
    {
        $em = $this->getDoctrine()->getManager();
        $activite1->setValider(1);
        $em->persist($activite1);
        $em->flush();

            return $this->redirectToRoute('aller_a_valider');

    }
    /**
     * Deletes a activite1 entity.
     *
     * @Route("/{idActivite}", name="activite1_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Activite1 $activite1,$format)
    {

        if($format=='json'){
            $data = (array)json_decode($request->getContent());
            $em=$this->getDoctrine()->getManager();
            $activite1 = $em->getRepository(Activite1::class)->find($data["id"]);
            $em->remove($activite1);
            $em->flush();
            return $this->redirectToRoute('Afficher_les_activite_a_reser');
        }
    }

    /**
     * Creates a form to delete a activite1 entity.
     *
     * @param Activite1 $activite1 The activite1 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Activite1 $activite1)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('supprimer_activite', array('idActivite' => $activite1->getIdactivite())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
