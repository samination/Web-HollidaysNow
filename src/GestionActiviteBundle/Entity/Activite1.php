<?php

namespace GestionActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Activite1
 *
 * @ORM\Table(name="activite1")
 * @ORM\Entity(repositoryClass="GestionActiviteBundle\Repository\Activite1Repository")
 */
class Activite1
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_activite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idActivite;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=60, nullable=false)
     *
     *  @Assert\NotBlank(message="veuillez saisir le nom svp")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=60, nullable=false)
     *
     *  @Assert\NotBlank(message="veuillez saisir le type svp")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=60, nullable=false)
     *
     *  @Assert\NotBlank(message="veuillez saisir l'adresse svp")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Pays", type="string", length=60, nullable=false)
     *
     * @Assert\NotBlank(message="veuillez saisir Pays svp")
     */
    private $pays;


    /**
     * @var string
     *
     * @ORM\Column(name="Region", type="string", length=60, nullable=false)
     *
     *  @Assert\NotBlank(message="veuillez saisir la Region svp")
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=60, nullable=false)
     *
     * @Assert\NotBlank(message="veuillez saisir une Description svp")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix", type="float", precision=10, scale=0, nullable=false)
     *
     *  @Assert\GreaterThan(
     * value=0,
     *     message="le prix doit etre >0"
     *)
     *
     *@Assert\NotBlank(message="veuillez saisir le prix svp")
     */
    private $prix;



    /**
     * @var integer
     *
     * @ORM\Column(name="PlaceDisponible", type="integer", nullable=false)
     *
     *  @Assert\GreaterThan(
     * value=0,
     *     message="PlaceDisponible invalide"
     *)
     *
     *@Assert\NotBlank(message="veuillez saisir nb de place disponible svp")
     */
    private $placedisponible;

    /**
     * @var integer
     *
     * @ORM\Column(name="valider", type="integer", nullable=false)
     */
    private $valider = '0';
    /**
     * @var integer
     *
     * @ORM\Column(name="idagence", type="integer")
     */
    private $idagence ;



    /**
     * Get idActivite
     *
     * @return integer
     */
    public function getIdActivite()
    {
        return $this->idActivite;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Activite1
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Activite1
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Activite1
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Activite1
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Activite1
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Activite1
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
     * Set prix
     *
     * @param float $prix
     *
     * @return Activite1
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
     * Set placedisponible
     *
     * @param integer $placedisponible
     *
     * @return Activite1
     */
    public function setPlacedisponible($placedisponible)
    {
        $this->placedisponible = $placedisponible;

        return $this;
    }

    /**
     * Get placedisponible
     *
     * @return integer
     */
    public function getPlacedisponible()
    {
        return $this->placedisponible;
    }

    /**
     * Set valider
     *
     * @param integer $valider
     *
     * @return Activite1
     */
    public function setValider($valider)
    {
        $this->valider = $valider;

        return $this;
    }

    /**
     * Get valider
     *
     * @return integer
     */
    public function getValider()
    {
        return $this->valider;
    }
    /**
     * Set idagence
     *
     * @param integer $idagence
     *
     * @return Activite1
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
}

