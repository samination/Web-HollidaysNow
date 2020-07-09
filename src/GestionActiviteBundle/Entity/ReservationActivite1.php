<?php

namespace GestionActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * ReservationActivite1
 *
 * @ORM\Table(name="reservation_activite1")
 * @ORM\Entity(repositoryClass="GestionActiviteBundle\Repository\ReservationActivite1Repository")
 */
class ReservationActivite1
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_reservationa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReservationa;


    /**
     * Get idReservationa
     *
     * @return integer
     */
    public function getIdReservationa()
    {
        return $this->idReservationa;
    }



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
     * @ORM\ManyToOne(targetEntity="GestionActiviteBundle\Entity\Activite1")
     * @ORM\JoinColumn(name="idactivite",referencedColumnName="Id_activite",onDelete="CASCADE")
     */
    private $idactivite;
    /**
     * Set idactivite
     *
     * @param integer $idactivite
     *
     * @return ReservationActivite1
     */
    public function setIdActivite($idactivite)
    {
        $this->idactivite = $idactivite;

        return $this;
    }

    /**
     * Get idactivite
     *
     * @return integer
     */
    public function getIdActivite()
    {
        return $this->idactivite;
    }


    /**
     * @var integer
     *
     * @ORM\Column(name="nbplace", type="integer")
     *
     *  @Assert\GreaterThan(
     * value=0,
     *     message="nb de place invalide"
     *)
     *
     *@Assert\NotBlank(message="veuillez saisir le nb de placesvp")
     *)
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

