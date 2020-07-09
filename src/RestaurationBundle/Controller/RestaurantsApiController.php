<?php

namespace RestaurationBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use RestaurationBundle\Entity\Favoris;
use RestaurationBundle\Entity\Resrevations;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use RestaurationBundle\Entity\Restaurants;
use RestaurationBundle\Form\rechercheRestaurantsForm;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;

class RestaurantsApiController extends FOSRestController

{
    /**
     * @Rest\Get("/all")
     */
    public function afficherAction()
    {
        $em=$this->getDoctrine()->getManager();
        $restaurant=$em->getRepository("RestaurationBundle:Restaurants")->findAll();
        return $restaurant;
    }

	/**
	 * @Rest\Get("/get/{id}")
	 */
	public function getAction($id)
	{
		$em=$this->getDoctrine()->getManager();
		$restaurant=$em->getRepository("RestaurationBundle:Restaurants")->find($id);
		if($restaurant == null){
			return new JsonResponse("null");
		}
		return $restaurant;
	}

    /**
     * @Rest\Get("/find/{mot}")
     */
    public function rechercheAction($mot)
    {
        $em=$this->getDoctrine()->getManager();
	    $restaurants = $em->getRepository('RestaurationBundle:Restaurants')->rechercheMot($mot);
	    return $restaurants;

    }


	/**
	 * @Rest\Get("/favoris/{idu}")
	 */
	public  function listeFavori($idu){
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('Esprit\UserBundle\Entity\User')->find($idu);
		$favoris = $em->getRepository('RestaurationBundle:Favoris')->findBy(
			array(
				'user' => $user
			)
		);
		$restaurants = [];
		foreach ($favoris as $fav){
			array_push($restaurants,$fav->getRestaurant());
		}
		return $restaurants;
	}

	/**
	 * @Rest\Get("/isliked/{idu}/{idr}")
	 */
	public  function islikeRestaurant($idu,$idr){
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('Esprit\UserBundle\Entity\User')->find($idu);
		$restaurant = $em->getRepository('RestaurationBundle:Restaurants')->find($idr);
		$favoris = $em->getRepository('RestaurationBundle:Favoris')->findOneBy(
			array(
				'user' => $user,
				'restaurant'=>$restaurant
			)
		);
		if($favoris != null) {
			return new JsonResponse('true');
		}
		return new JsonResponse('false');
	}

	/**
	 * @Rest\Get("/like/{idu}/{idr}")
	 */
	public  function likeRestaurant($idu,$idr){
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('Esprit\UserBundle\Entity\User')->find($idu);
		$restaurant = $em->getRepository('RestaurationBundle:Restaurants')->find($idr);
		$favoris = $em->getRepository('RestaurationBundle:Favoris')->findOneBy(
			array(
				'user' => $user,
				'restaurant'=>$restaurant
			)
		);
		if($favoris != null) {
			return new JsonResponse('already liked');
		}
		$favoris = new Favoris();
		$favoris->setUser($user);
		$favoris->setRestaurant($restaurant);
		$em->persist($favoris);
		$em->flush();
		return new JsonResponse('liked');
	}

	/**
	 * @Rest\Get("/dislike/{idu}/{idr}")
	 */
	public  function dislikeRestaurant($idu,$idr){
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('Esprit\UserBundle\Entity\User')->find($idu);
		$restaurant = $em->getRepository('RestaurationBundle:Restaurants')->find($idr);
		$favoris = $em->getRepository('RestaurationBundle:Favoris')->findOneBy(
			array(
				'user' => $user,
				'restaurant'=>$restaurant
			)
		);
		if($favoris == null) {
			return new JsonResponse('not liked');
		}
		$em->remove($favoris);
		$em->flush();
		return new JsonResponse('disliked');
	}

	/**
	 * @Rest\Post("/add")
	 */
    public function ajouterAction(Request $request)
    {
		$em= $this->getDoctrine()->getManager();
	    $restaurant=new Restaurants();
        if($request->isMethod('POST')) {
	        $restaurant->setNomResto( $request->get( 'nom' ) );
	        $restaurant->setAdresseResto( $request->get( 'adresse' ) );
	        $restaurant->setSpecialiteResto( $request->get( 'specialite' ) );
	        $restaurant->setTypeResto( $request->get( 'type' ) );
	        $restaurant->setNbPlacesTotResto( $request->get( 'place' ) );
	        $restaurant->setIdAgence( $request->get( 'agence' ) );
	        $em->persist( $restaurant );
	        $em->flush();
			return new Response("added");
        }
	    return new Response("error adding");
    }

	/**
	 * @Rest\Post("/modify")
	 */
	public function modifierAction(Request $request)
	{
		$em= $this->getDoctrine()->getManager();
		$restaurant= $em->getRepository('RestaurationBundle:Restaurants')->find( $request->get( 'id' ) );
		if($request->isMethod('POST')) {
			$restaurant->setNomResto( $request->get( 'nom' ) );
			$restaurant->setAdresseResto( $request->get( 'adresse' ) );
			$restaurant->setSpecialiteResto( $request->get( 'specialite' ) );
			$restaurant->setTypeResto( $request->get( 'type' ) );
			$restaurant->setNbPlacesTotResto( $request->get( 'place' ) );
			$restaurant->setIdAgence( $request->get( 'agence' ) );
			$em->persist( $restaurant );
			$em->flush();
			return new Response("modified");
		}
		return new Response("error modifying");
	}


	/**
	 * @Rest\Post("/delete/{id}")
	 */
	public function deleteAction($id)
	{
		$em= $this->getDoctrine()->getManager();
		$restaurant= $em->getRepository('RestaurationBundle:Restaurants')->find($id);
		if($restaurant != null){
			$em->remove( $restaurant );
			$em->flush();
			return new Response("deleted");
		}
		return new Response("error deleting ...");
	}

	/**
	 * @Rest\Post("/book")
	 */
	public function bookAction(Request $request) {
		$reservation = new Resrevations();
		$em          = $this->getDoctrine()->getManager();
		if ( $request->isMethod( 'POST' ) ) {
			$idr  = $request->get( 'idr' );
			$idu  = $request->get( 'idu' );
			$date = $request->get( 'date' );
			$nbp  = $request->get( 'nbp' );
			$reservation->setDateRes( $date );
			$reservation->setIdAgence( $idu );
			$reservation->setIdResto( $idr );
			$reservation->setNbPersonnes( $nbp );
			$em->persist($reservation);
			$em->flush();
			return new Response("reserved");
		}
		return new Response("error reserving ...");
	}

	/**
	 * @Rest\Get("/cancelBook/{id}")
	 */
	public function cancelReservation($id) {
		$em          = $this->getDoctrine()->getManager();
		$reservation = $em->getRepository('RestaurationBundle:Resrevations')->find($id);
		if($reservation != null){
			$em->remove($reservation);
			$em->flush();
			return new Response("canceling");
		}
		return new Response("error canceling ...");
	}


	/**
	 * @Rest\Get("/isReserved/{idu}/{idr}")
	 */
	public function isReservd($idu,$idr) {
		$em          = $this->getDoctrine()->getManager();
		$reservation = $em->getRepository('RestaurationBundle:Resrevations')->findOneBy(array(
			'Id_agence'=>$idu,
			'idResto'=>$idr
		));
		if($reservation != null)
			return new JsonResponse(true);
		return new JsonResponse(false);
	}

	/**
	 * @Rest\Get("/myReservations/{idu}")
	 */
	public function reservationsByUser($idu) {
		$em          = $this->getDoctrine()->getManager();
		$reservations = $em->getRepository('RestaurationBundle:Resrevations')->findBy(array(
			'Id_agence'=>$idu
		));
		if($reservations != null){
			return $reservations;
		}
		return new Response("null");
	}

}