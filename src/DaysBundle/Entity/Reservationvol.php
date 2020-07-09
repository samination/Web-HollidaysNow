<?php

namespace DaysBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationvol
 *
 * @ORM\Table(name="reservationvol")
 * @ORM\Entity
 */
class Reservationvol
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReservation;

    /**
     * Get idReservation
     *
     * @return integer
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }



    /**
     * @ORM\ManyToOne(targetEntity="DaysBundle\Entity\Vols")
     * @ORM\JoinColumn(name="$idVol",referencedColumnName="id_vol",onDelete="CASCADE")
     */
    private $idVol;

    /**
     * Set idVol
     *
     * @param integer $idVol
     *
     * @return Reservationvol
     */
    public function setIdVol($idVol)
    {
        $this->idVol = $idVol;

        return $this;
    }

    /**
     * Get idVol
     *
     * @return integer
     */
    public function getIdVol()
    {
        return $this->idVol;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Reservationvol
     */





    /**
     * @var integer
     *
     * @ORM\Column(name="idagence", type="integer")
     */
    private $idagence ;
    /**
     * Set idagence
     *
     * @param integer $idagence
     *
     * @return ReservationActivite1
     */
    public function setIdagence($idagence)
    {
        $this->idagence = $idagence;

        return $this;
    }

    /**
     * Get idagence
     *
     * @return integer
     */
    public function getIdagence()
    {
        return $this->idagence;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="idclient", type="integer")
     */
    private $idclient;
    /**
     * Set idclient
     *
     * @param integer $idclient
     *
     * @return ReservationActivite1
     */
    public function setIdclient($idclient)
    {
        $this->idclient = $idclient;

        return $this;
    }

    /**
     * Get idclient
     *
     * @return integer
     */
    public function getIdclient()
    {
        return $this->idclient;
    }


    /**
     * @var integer
     *
     * @ORM\Column(name="nbplace", type="integer")
     */
    private $nbplace ;
    /**
     * Set nbplace
     *
     * @param integer $nbplace
     *
     * @return ReservationActivite1
     */
    public function setNbplace($nbplace)
    {
        $this->nbplace = $nbplace;

        return $this;
    }

    /**
     * Get nbplace
     *
     * @return integer
     */
    public function getNbplace()
    {
        return $this->nbplace;
    }



    /**
     * @var float
     *
     * @ORM\Column(name="Prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;
    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return ReservationActivite1
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }
    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }


}
