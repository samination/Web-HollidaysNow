<?php

namespace RestaurationBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use RestaurationBundle\Entity\Restaurants;
use RestaurationBundle\Form\rechercheRestaurantsForm;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;

class AgenceApiController extends FOSRestController

{
    /**
     * @Rest\Get("/get/{id}")
     */
    public function getAgence($id)
    {
        $em=$this->getDoctrine()->getManager();
        $restaurant=$em->getRepository("RestaurationBundle:Agence")->find($id);
        return $restaurant;

    }



}