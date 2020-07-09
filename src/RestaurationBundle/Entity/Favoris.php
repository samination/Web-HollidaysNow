<?php

namespace RestaurationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activite
 *
 * @ORM\Table(name="favoris")
 * @ORM\Entity
 */
class Favoris
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Esprit\UserBundle\Entity\User")
	 */
	private $user;

	/**
	 * @ORM\ManyToOne(targetEntity="RestaurationBundle\Entity\Restaurants",cascade={"persist"})
	 * @ORM\JoinColumn(name="id_resto", referencedColumnName="id_resto", onDelete="CASCADE")
	 */
	private $restaurant;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param mixed $user
	 */
	public function setUser( $user ) {
		$this->user = $user;
	}

	/**
	 * @return mixed
	 */
	public function getRestaurant() {
		return $this->restaurant;
	}

	/**
	 * @param mixed $restaurant
	 */
	public function setRestaurant( $restaurant ) {
		$this->restaurant = $restaurant;
	}


}

