<?php

namespace VoyageOrganiseBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voyageorganise
 *
 * @ORM\Table(name="voyageorganise")
 * @ORM\Entity(repositoryClass="VoyageOrganiseBundle\Repository\VoyageOrganiseRepository")
 */
class Voyageorganise
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
     * @var integer
     *
     * @ORM\Column(name="prix_voyage", type="integer", nullable=false)
     */
    private $prixVoyage;

    /**
     * @var \Datetime
     * @Assert\Type(
     *      type = "\DateTime",
     *      message = "vacancy.date.valid",
     * )
     * @Assert\GreaterThanOrEqual(
     *      value = "today",
     *      message = "Veuillez selectionner une date de départ valide"
     * )
     * @ORM\Column(name="date_depart", type="date", nullable=false)
     */
    private $dateDepart;


    /**
     * @var \Datetime
     * @Assert\Type(
     *      type = "\DateTime",
     *      message = "Veuillez selectionner une date de retour valide",
     * )
     * @Assert\GreaterThanOrEqual(
     *      value = "today",
     *      message = "Veuillez selectionner une date de retour apres la date de départ"
     * )
     * @Assert\Expression(
     *     "this.getDateRetour() >= this.getDateDepart()",
     *     message="Veuillez selectionner une date de retour valide"
     * )
     * @ORM\Column(name="date_retour", type="date", nullable=false)
     */
    private $dateRetour;

    /**
     * @var string
     *
     * @ORM\Column(name="origine", type="text", length=65535, nullable=false)
     */
    private $origine;

    /**
     * @var string
     *
     * @ORM\Column(name="pays_destination", type="text", length=65535, nullable=false)
     */
    private $paysDestination;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_destination", type="text", length=65535, nullable=false)
     */
    private $villeDestination;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_places", type="integer", nullable=false)
     */
    private $nbPlaces;

    /**
     * @var string
     *
     * @ORM\Column(name="hotel", type="text", length=65535, nullable=false)
     */
    private $hotel;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_agence", type="integer", nullable=false)
     */
    private $idAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_agence", type="text", length=65535, nullable=false)
     */
    private $nomAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=225, nullable=false)
     */
    private $image;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPrixVoyage()
    {
        return $this->prixVoyage;
    }

    /**
     * @param int $prixVoyage
     */
    public function setPrixVoyage($prixVoyage)
    {
        $this->prixVoyage = $prixVoyage;
    }

    /**
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * @param \DateTime $dateDepart
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;
    }

    /**
     * @return \DateTime
     */
    public function getDateRetour()
    {
        return $this->dateRetour;
    }

    /**
     * @param \DateTime $dateRetour
     */
    public function setDateRetour($dateRetour)
    {
        $this->dateRetour = $dateRetour;
    }

    /**
     * @return string
     */
    public function getOrigine()
    {
        return $this->origine;
    }

    /**
     * @param string $origine
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;
    }

    /**
     * @return string
     */
    public function getPaysDestination()
    {
        return $this->paysDestination;
    }

    /**
     * @param string $paysDestination
     */
    public function setPaysDestination($paysDestination)
    {
        $this->paysDestination = $paysDestination;
    }

    /**
     * @return string
     */
    public function getVilleDestination()
    {
        return $this->villeDestination;
    }

    /**
     * @param string $villeDestination
     */
    public function setVilleDestination($villeDestination)
    {
        $this->villeDestination = $villeDestination;
    }

    /**
     * @return int
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * @param int $nbPlaces
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;
    }

    /**
     * @return string
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * @param string $hotel
     */
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;
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
     * @return string
     */
    public function getNomAgence()
    {
        return $this->nomAgence;
    }

    /**
     * @param string $nomAgence
     */
    public function setNomAgence($nomAgence)
    {
        $this->nomAgence = $nomAgence;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

  /*  public function __toString() {
        return (string) $this->id; }*/
}

