<?php

namespace HebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Hebergement
 *
 * @ORM\Table(name="hebergement")
 * @ORM\Entity(repositoryClass="HebergementBundle\Repository\HebergementRepositery")
 */
class Hebergement
{


    /**
     * @var integer
     *
     * @ORM\Column(name="idHebergement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idhebergement;

    /**
     * @var integer
     *
     * @ORM\Column(name="idAgence", type="integer", nullable=true)
     */
    private $idagence;

    /**
     * @var string
     *
     * @ORM\Column(name="nomAgence", type="text", length=65535, nullable=false)
     */
    private $nomagence;

    /**
     * @var string
     *
     * @ORM\Column(name="type_Hebergement", type="text", length=65535, nullable=false)
     */
    private $typeHebergement;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_Hebergement", type="text", length=65535, nullable=false)
     */
    private $nomHebergement;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_etoile", type="integer", nullable=false)
     */
    private $nombreEtoile;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse_Hebergement", type="text", length=65535, nullable=false)
     */
    private $adresseHebergement;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_chambre", type="integer", nullable=false)
     */
    private $nombreChambre;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_single", type="integer", nullable=false)
     */
    private $prixSingle;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_double", type="integer", nullable=false)
     */
    private $prixDouble;

    /**
     * @var integer
     *
     * @ORM\Column(name="taux_demi", type="integer", nullable=false)
     */
    private $tauxDemi;

    /**
     * @var integer
     *
     * @ORM\Column(name="taux_complet", type="integer", nullable=false)
     */
    private $tauxComplet;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="text", length=65535, nullable=false)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=225, nullable=true)
     */
    private $image;

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
     * @return string
     */
    public function getNomagence()
    {
        return $this->nomagence;
    }

    /**
     * @param string $nomagence
     */
    public function setNomagence($nomagence)
    {
        $this->nomagence = $nomagence;
    }

    /**
     * @return string
     */
    public function getTypeHebergement()
    {
        return $this->typeHebergement;
    }

    /**
     * @param string $typeHebergement
     */
    public function setTypeHebergement($typeHebergement)
    {
        $this->typeHebergement = $typeHebergement;
    }

    /**
     * @return string
     */
    public function getNomHebergement()
    {
        return $this->nomHebergement;
    }

    /**
     * @param string $nomHebergement
     */
    public function setNomHebergement($nomHebergement)
    {
        $this->nomHebergement = $nomHebergement;
    }

    /**
     * @return int
     */
    public function getNombreEtoile()
    {
        return $this->nombreEtoile;
    }

    /**
     * @param int $nombreEtoile
     */
    public function setNombreEtoile($nombreEtoile)
    {
        $this->nombreEtoile = $nombreEtoile;
    }

    /**
     * @return string
     */
    public function getAdresseHebergement()
    {
        return $this->adresseHebergement;
    }

    /**
     * @param string $adresseHebergement
     */
    public function setAdresseHebergement($adresseHebergement)
    {
        $this->adresseHebergement = $adresseHebergement;
    }

    /**
     * @return int
     */
    public function getNombreChambre()
    {
        return $this->nombreChambre;
    }

    /**
     * @param int $nombreChambre
     */
    public function setNombreChambre($nombreChambre)
    {
        $this->nombreChambre = $nombreChambre;
    }

    /**
     * @return int
     */
    public function getPrixSingle()
    {
        return $this->prixSingle;
    }

    /**
     * @param int $prixSingle
     */
    public function setPrixSingle($prixSingle)
    {
        $this->prixSingle = $prixSingle;
    }

    /**
     * @return int
     */
    public function getPrixDouble()
    {
        return $this->prixDouble;
    }

    /**
     * @param int $prixDouble
     */
    public function setPrixDouble($prixDouble)
    {
        $this->prixDouble = $prixDouble;
    }

    /**
     * @return int
     */
    public function getTauxDemi()
    {
        return $this->tauxDemi;
    }

    /**
     * @param int $tauxDemi
     */
    public function setTauxDemi($tauxDemi)
    {
        $this->tauxDemi = $tauxDemi;
    }

    /**
     * @return int
     */
    public function getTauxComplet()
    {
        return $this->tauxComplet;
    }

    /**
     * @param int $tauxComplet
     */
    public function setTauxComplet($tauxComplet)
    {
        $this->tauxComplet = $tauxComplet;
    }

    /**
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param string $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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

   /* public function __toString() {
        return (string) $this->idhebergement; }*/


}

