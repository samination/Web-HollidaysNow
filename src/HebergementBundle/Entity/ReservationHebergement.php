<?php

namespace HebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationHebergement
 *
 * @ORM\Table(name="reservation_hebergement")
 * @ORM\Entity(repositoryClass="HebergementBundle\Repository\HebergementRepositery")
 */
class ReservationHebergement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idReservationh", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservationh;

    /**
     * @ORM\ManyToOne(targetEntity="HebergementBundle\Entity\Hebergement")
     * @ORM\JoinColumn(name="idhebergement",referencedColumnName="idHebergement", nullable=false ,onDelete="CASCADE")
     */
    private $idhebergement;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUtilisateur", type="integer", nullable=true)
     */
    private $idutilisateur;

    /**
     * @var integer
     *
     * @ORM\Column(name="idagence", type="integer", nullable=true)
     */
    private $idagence;
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
     * @var string
     *
     * @ORM\Column(name="typechambre", type="string", nullable=false)
     */
    private $typechambre;

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
    public function getIdreservationh()
    {
        return $this->idreservationh;
    }

    /**
     * @param int $idreservationh
     */
    public function setIdreservationh($idreservationh)
    {
        $this->idreservationh = $idreservationh;
    }

    /**
     * @return int
     */
    public function getIdhebergement()
    {
        return $this->idhebergement;
    }

    /**
     * @param int $idhebergement
     */
    public function setIdhebergement($idhebergement)
    {
        $this->idhebergement = $idhebergement;
    }

    /**
     * @return int
     */
    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    /**
     * @param int $idutilisateur
     */
    public function setIdutilisateur($idutilisateur)
    {
        $this->idutilisateur = $idutilisateur;
    }

    /**
     * @return int
     */
    public function getIdagence()
    {
        return $this->idagence;
    }

    /**
     * @param int $idagence
     */
    public function setIdagence($idagence)
    {
        $this->idagence = $idagence;
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

    /**
     * @return int
     */
    public function getTypechambre()
    {
        return $this->typechambre;
    }

    /**
     * @param int $typechambre
     */
    public function setTypechambre($typechambre)
    {
        $this->typechambre = $typechambre;
    }

    public function __toString()
    {
        return "Reservation N°".$this->getIdreservationh()."  Client : ".$this->getIdutilisateur() ."Nombre de place : ".$this->getNbrplace()."Prix : ".$this->getPrix();
    }



}

