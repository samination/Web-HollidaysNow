<?php

namespace DaysBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Vols
 *
 * @ORM\Table(name="vols")
 * @ORM\Entity
 */
class Vols
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_vol", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_depart", type="date", nullable=false)
     *
     * @Assert\GreaterThanOrEqual ("today")
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_arrive", type="date", nullable=false)
     *
     * @Assert\GreaterThan ("+24 hours")
     */
    private $dateArrive;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_depart", type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank(message="veuillez saisir le ville de depart svp")
     */
    private $villeDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_arrive", type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank(message="veuillez saisir la ville d'arrivee svp")
     */
    private $villeArrive;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     *
     * @Assert\GreaterThan(
     * value=0,
     *     message="le prix doit etre >0"
     *)
     *
     *@Assert\NotBlank(message="veuillez saisir le prix svp")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank(message="veuillez saisir une ddescription svp")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="text", length=65535, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_places", type="integer", nullable=false)
     *
     * @Assert\GreaterThan(
     * value=0,
     *     message="nb de place invalide"
     *)
     *
     *@Assert\NotBlank(message="veuillez saisir nb")
     */
    private $nbPlaces;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_agence", type="integer", nullable=false)
     *
     * @Assert\GreaterThan(
     * value=0,
     *     message="nb de place invalide"
     *)
     *
     *@Assert\NotBlank(message="veuillez saisir le nb de placesvp")
     */
    private $idAgence;



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
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     *
     * @return Vols
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    /**
     * Get dateDepart
     *
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Set dateArrive
     *
     * @return Vols
     */
    public function setDateArrive($dateArrive)
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }

    /**
     * Get dateArrive
     *
     * @return \DateTime
     */
    public function getDateArrive()
    {
        return $this->dateArrive;
    }

    /**
     * Set villeDepart
     *
     * @param string $villeDepart
     *
     * @return Vols
     */
    public function setVilleDepart($villeDepart)
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    /**
     * Get villeDepart
     *
     * @return string
     */
    public function getVilleDepart()
    {
        return $this->villeDepart;
    }

    /**
     * Set villeArrive
     *
     * @param string $villeArrive
     *
     * @return Vols
     */
    public function setVilleArrive($villeArrive)
    {
        $this->villeArrive = $villeArrive;

        return $this;
    }

    /**
     * Get villeArrive
     *
     * @return string
     */
    public function getVilleArrive()
    {
        return $this->villeArrive;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Vols
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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Vols
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Vols
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set nbPlaces
     *
     * @param integer $nbPlaces
     *
     * @return Vols
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * Get nbPlaces
     *
     * @return integer
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * Set idAgence
     *
     * @param integer $idAgence
     *
     * @return Vols
     */
    public function setIdAgence($idAgence)
    {
        $this->idAgence = $idAgence;

        return $this;
    }

    /**
     * Get idAgence
     *
     * @return integer
     */
    public function getIdAgence()
    {
        return $this->idAgence;
    }
}
