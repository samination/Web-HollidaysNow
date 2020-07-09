<?php

namespace RestaurationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restaurants
 *
 * @ORM\Table(name="restaurants")
 * @ORM\Entity(repositoryClass="RestaurationBundle\Repository\RestaurantRepository")
 */
class Restaurants
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_resto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idResto;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_places_tot_resto", type="integer", nullable=false)
     */
    private $nbPlacesTotResto;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_resto", type="string", length=1000, nullable=false)
     */
    private $nomResto;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_resto", type="string", length=1000, nullable=false)
     */
    private $adresseResto;

    /**
     * @var string
     *
     * @ORM\Column(name="type_resto", type="string", length=1000, nullable=false)
     */
    private $typeResto;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite_resto", type="string", length=1000, nullable=false)
     */
    private $specialiteResto;


    /**
     * @ORM\Column(type="integer")
     */
    private $Id_agence;

    /**
     * @return int
     */
    public function getIdResto()
    {
        return $this->idResto;
    }

    /**
     * @param int $idResto
     */
    public function setIdResto($idResto)
    {
        $this->idResto = $idResto;
    }

    /**
     * @return int
     */
    public function getNbPlacesTotResto()
    {
        return $this->nbPlacesTotResto;
    }

    /**
     * @param int $nbPlacesTotResto
     */
    public function setNbPlacesTotResto($nbPlacesTotResto)
    {
        $this->nbPlacesTotResto = $nbPlacesTotResto;
    }

    /**
     * @return string
     */
    public function getNomResto()
    {
        return $this->nomResto;
    }

    /**
     * @param string $nomResto
     */
    public function setNomResto($nomResto)
    {
        $this->nomResto = $nomResto;
    }

    /**
     * @return string
     */
    public function getAdresseResto()
    {
        return $this->adresseResto;
    }

    /**
     * @param string $adresseResto
     */
    public function setAdresseResto($adresseResto)
    {
        $this->adresseResto = $adresseResto;
    }

    /**
     * @return string
     */
    public function getTypeResto()
    {
        return $this->typeResto;
    }

    /**
     * @param string $typeResto
     */
    public function setTypeResto($typeResto)
    {
        $this->typeResto = $typeResto;
    }

    /**
     * @return string
     */
    public function getSpecialiteResto()
    {
        return $this->specialiteResto;
    }

    /**
     * @param string $specialiteResto
     */
    public function setSpecialiteResto($specialiteResto)
    {
        $this->specialiteResto = $specialiteResto;
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




}

