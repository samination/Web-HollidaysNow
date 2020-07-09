<?php

namespace RestaurationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agence
 *
 * @ORM\Table(name="agence")
 * @ORM\Entity
 */
class Agence
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_agence", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_agence", type="string", length=60, nullable=false)
     */
    private $nomAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="Email_agence", type="string", length=60, nullable=false)
     */
    private $emailAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="Mdp_agence", type="string", length=60, nullable=false)
     */
    private $mdpAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse_agence", type="string", length=60, nullable=false)
     */
    private $adresseAgence;

    /**
     * @var integer
     *
     * @ORM\Column(name="Telephone_agence", type="integer", nullable=false)
     */
    private $telephoneAgence;

    /**
     * @var integer
     *
     * @ORM\Column(name="Fax_agence", type="integer", nullable=false)
     */
    private $faxAgence;

    /**
     * @var integer
     *
     * @ORM\Column(name="Role_agence", type="integer", nullable=false)
     */
    private $roleAgence = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="Connecter_agence", type="integer", nullable=false)
     */
    private $connecterAgence = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="verifier", type="integer", nullable=false)
     */
    private $verifier = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="bloquer", type="integer", nullable=false)
     */
    private $bloquer = '0';


}

