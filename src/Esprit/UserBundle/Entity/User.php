<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 15/11/2018
 * Time: 21:14
 */
namespace Esprit\UserBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nom;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $prenom;

	/**
	 * @ORM\Column(type="string")
	 */
	private $Sexe_user;

	/**
	 * @ORM\Column(type="string")
	 */
	private $Telephone_user;


	/**
	 * @ORM\Column(type="string")
	 */
	private $rolejava;

	/**
	 * @ORM\Column(type="string")
	 */
	private $Adresse_user;

	/**
	 * @ORM\Column(type="string")
	 */
	private $Connecter_user;

	/**
	 * @return mixed
	 */
	public function getConnecterUser() {
		return $this->Connecter_user;
	}

	/**
	 * @param mixed $Connecter_user
	 */
	public function setConnecterUser( $Connecter_user ) {
		$this->Connecter_user = $Connecter_user;
	}

	/**
	 * @return mixed
	 */
	public function getSexeUser() {
		return $this->Sexe_user;
	}

	/**
	 * @param mixed $Sexe_user
	 */
	public function setSexeUser( $Sexe_user ) {
		$this->Sexe_user = $Sexe_user;
	}

	/**
	 * @return mixed
	 */
	public function getTelephoneUser() {
		return $this->Telephone_user;
	}

	/**
	 * @param mixed $Telephone_user
	 */
	public function setTelephoneUser( $Telephone_user ) {
		$this->Telephone_user = $Telephone_user;
	}

	/**
	 * @return mixed
	 */
	public function getAdresseUser() {
		return $this->Adresse_user;
	}

	/**
	 * @param mixed $Adresse_user
	 */
	public function setAdresseUser( $Adresse_user ) {
		$this->Adresse_user = $Adresse_user;
	}

	/**
	 * @return mixed
	 */
	public function getRolejava() {
		return $this->rolejava;
	}

	/**
	 * @param mixed $rolejava
	 */
	public function setRolejava( $rolejava ) {
		$this->rolejava = $rolejava;
	}


    public function __construct()
    {
        parent::__construct();
    }
}