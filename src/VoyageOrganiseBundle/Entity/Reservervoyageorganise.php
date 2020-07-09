<?php

namespace VoyageOrganiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservervoyageorganise
 *
 * @ORM\Table(name="reservervoyageorganise")
 * @ORM\Entity(repositoryClass="VoyageOrganiseBundle\Repository\ReserverVoyageOrganiseRepository")
 */
class Reservervoyageorganise
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_reservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReservation;

    /**
     *
     * @ORM\ManyToOne(targetEntity="VoyageOrganiseBundle\Entity\Voyageorganise")
     * @ORM\JoinColumn(name="idVoyageorganise",referencedColumnName="id",onDelete="CASCADE")
     */
    private $idVoyageorganise;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_agence", type="integer", nullable=true)
     */
    private $idAgence;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrplace", type="integer", nullable=false)
     */
    private $nbrplace;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @return int
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @param int $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

    /**
     * @return mixed
     */
    public function getIdVoyageorganise()
    {
        return $this->idVoyageorganise;
    }

    /**
     * @param mixed $idVoyageorganise
     */
    public function setIdVoyageorganise($idVoyageorganise)
    {
        $this->idVoyageorganise = $idVoyageorganise;
    }

    /**
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return int
     */
    public function getIdAgence()
    {
        return $this->idAgence;
    }

    /**
     * @param int $idAgence
     */
    public function setIdAgence($idAgence)
    {
        $this->idAgence = $idAgence;
    }

    /**
     * @return int
     */
    public function getNbrplace()
    {
        return $this->nbrplace;
    }

    /**
     * @param int $nbrplace
     */
    public function setNbrplace($nbrplace)
    {
        $this->nbrplace = $nbrplace;
    }

    /**
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }


}

