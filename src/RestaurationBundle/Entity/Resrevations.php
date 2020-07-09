<?php

namespace RestaurationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * Resrevations
 *
 * @ORM\Table(name="resrevations")
 * @ORM\Entity(repositoryClass="RestaurationBundle\Repository\ReservationRestaurantRepository")
 */

class Resrevations
{
     /**
         *
         * @ORM\ManyToOne(targetEntity="RestaurationBundle\Entity\Restaurants")
         * @ORM\JoinColumn(referencedColumnName="id_resto",nullable=false)
         */




    /**
     * @var integer
     *
     * @ORM\Column(name="id_res", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */

    private $idRes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_res", type="string", nullable=false)
     */
    private $dateRes ;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_personnes", type="integer", nullable=false)
     */
    private $nbPersonnes;


    /**
     * @ORM\Column(type="integer")
     *
     */
    private $idResto;
    /**

     * @ORM\Column(type="integer")
     */
    private $Id_agence;

    /**
     * @return int
     */
    public function getIdRes()
    {
        return $this->idRes;
    }

    /**
     * @param int $idRes
     */
    public function setIdRes($idRes)
    {
        $this->idRes = $idRes;
    }

    /**
     * @return \DateTime
     */
    public function getDateRes()
    {
        return $this->dateRes;
    }

    /**
     * @param \DateTime $dateRes
     */
    public function setDateRes($dateRes)
    {
        $this->dateRes = $dateRes;
    }

    /**
     * @return int
     */

     public function getNbPersonnes()
     {

        return $this->nbPersonnes;
    }

    /**
     * @param int $nbPersonnes
     */
    public function setNbPersonnes($nbPersonnes)
    {
        $this->nbPersonnes = $nbPersonnes;
    }

    /**
     * @return mixed
     */
    public function getIdAgence()
    {
        return $this->Id_agence;
    }

    /**
     * @param mixed $Id_agence
     */
    public function setIdAgence($Id_agence)
    {
        $this->Id_agence = $Id_agence;
    }

    /**
     * @return mixed
     */
    public function getIdResto()
    {
        return $this->idResto;
    }

    /**
     * @param mixed $idResto
     */
    public function setIdResto($idResto)
    {
        $this->idResto = $idResto;
    }
}

