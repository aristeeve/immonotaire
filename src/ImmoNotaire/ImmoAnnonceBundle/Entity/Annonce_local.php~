<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Annonce_local
 *
 * @ORM\Table(name="annonce_local")
 * @ORM\Entity(repositoryClass="ImmoNotaire\ImmoAnnonceBundle\Repository\Annonce_localRepository")
 */
class Annonce_local
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\ManyToOne(targetEntity="ImmoNotaire\ImmoNotaireBundle\Entity\User", inversedBy="annonce_local")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce",cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;

    /**
     * @ORM\ManyToOne(targetEntity="ImmoNotaire\ImmoAnnonceBundle\Entity\Type_local",cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_local;

    /**
     * @var string
     *  @Assert\Type(
     *     type="integer",
     *     message="cette valeur doit être un nombre."
     * )
     *
     * @ORM\Column(name="superficie", type="string", length=255, nullable=true)
     */
    private $superficie;

    /**
     * @var string
     * 
     *  @Assert\Type(
     *     type="integer",
     *     message="cette valeur doit être un nombre."
     * )
     *
     * @ORM\Column(name="espace_habitable", type="string", length=255, nullable=true)
     */
    private $espace_habitable;

    /**
     * @var int
     * 
     *  @Assert\Type(
     *     type="integer",
     *     message="cette valeur doit être un nombre."
     * )
     *
     * @ORM\Column(name="piece", type="integer", nullable=true)
     */
    private $piece;

    /**
     * @var int
     * 
     *  @Assert\Type(
     *     type="integer",
     *     message="cette valeur doit être un nombre."
     * )
     *
     * @ORM\Column(name="etage", type="integer", nullable=true)
     */
    private $etage;

    /**
     * @var int
     * 
     *  @Assert\Type(
     *     type="integer",
     *     message="cette valeur doit être un nombre."
     * )
     *
     * @ORM\Column(name="niveau_etage", type="integer", nullable=true)
     */
    private $niveau_etage;

    /**
     * @var int
     * 
     *  @Assert\Type(
     *     type="integer",
     *     message="cette valeur doit être un nombre."
     * )
     *
     * @ORM\Column(name="annee", type="integer", nullable=true)
     */
    private $annee;

    /**
     * @var string
     * 
     *  
     *
     * @ORM\Column(name="meuble", type="string", length=255,nullable=true)
     */
    private $meuble;

    /**
     * @var int
     * 
     *  @Assert\Type(
     *     type="integer",
     *     message="cette valeur doit être un nombre."
     * )
     *
     * @ORM\Column(name="place_parking", type="integer", nullable=true)
     */
    private $place_parking;

    /**
     * @var bool
     *
     * @ORM\Column(name="interphone", type="boolean")
     */
    private $interphone;

    /**
     * @var bool
     *
     * @ORM\Column(name="chauffe_eau", type="boolean")
     */
    private $chauffe_eau;

    /**
     * @var bool
     *
     * @ORM\Column(name="balcon", type="boolean")
     */
    private $balcon;

    /**
     * @var bool
     *
     * @ORM\Column(name="cour", type="boolean")
     */
    private $cour;

    /**
     * @var bool
     *
     * @ORM\Column(name="piscine", type="boolean")
     */
    private $piscine;

    /**
     * @var bool
     *
     * @ORM\Column(name="jardin", type="boolean")
     */
    private $jardin;

    /**
     * @var bool
     *
     * @ORM\Column(name="garage", type="boolean")
     */
    private $garage;

    /**
     * @var bool
     *
     * @ORM\Column(name="parking", type="boolean")
     */
    private $parking;

    /**
     * @var bool
     *
     * @ORM\Column(name="ascenseur", type="boolean")
     */
    private $ascenseur;

    /**
     * @var bool
     *
     * @ORM\Column(name="gardiennage", type="boolean")
     */
    private $gardiennage;

    /**
     * @var bool
     *
     * @ORM\Column(name="systeme_alarme", type="boolean")
     */
    private $systeme_alarme;


    /**
     * @var bool
     *
     * @ORM\Column(name="bordure_route", type="boolean")
     */
    private $bordure_route;

    /**
     * @var bool
     *
     * @ORM\Column(name="vue_lagune", type="boolean")
     */
    private $vue_lagune;

    /**
     * @var bool
     *
     * @ORM\Column(name="vue_mer", type="boolean")
     */
    private $vue_mer;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set superficie
     *
     * @param string $superficie
     *
     * @return Annonce_local
     */
    public function setSuperficie($superficie)
    {
        $this->superficie = $superficie;

        return $this;
    }

    /**
     * Get superficie
     *
     * @return string
     */
    public function getSuperficie()
    {
        return $this->superficie;
    }

    /**
     * Set espaceHabitable
     *
     * @param string $espaceHabitable
     *
     * @return Annonce_local
     */
    public function setEspaceHabitable($espaceHabitable)
    {
        $this->espace_habitable = $espaceHabitable;

        return $this;
    }

    /**
     * Get espaceHabitable
     *
     * @return string
     */
    public function getEspaceHabitable()
    {
        return $this->espace_habitable;
    }

    /**
     * Set piece
     *
     * @param integer $piece
     *
     * @return Annonce_local
     */
    public function setPiece($piece)
    {
        $this->piece = $piece;

        return $this;
    }

    /**
     * Get piece
     *
     * @return integer
     */
    public function getPiece()
    {
        return $this->piece;
    }

    /**
     * Set etage
     *
     * @param integer $etage
     *
     * @return Annonce_local
     */
    public function setEtage($etage)
    {
        $this->etage = $etage;

        return $this;
    }

    /**
     * Get etage
     *
     * @return integer
     */
    public function getEtage()
    {
        return $this->etage;
    }

    /**
     * Set niveauEtage
     *
     * @param integer $niveauEtage
     *
     * @return Annonce_local
     */
    public function setNiveauEtage($niveauEtage)
    {
        $this->niveau_etage = $niveauEtage;

        return $this;
    }

    /**
     * Get niveauEtage
     *
     * @return integer
     */
    public function getNiveauEtage()
    {
        return $this->niveau_etage;
    }

    /**
     * Set annee
     *
     * @param integer $annee
     *
     * @return Annonce_local
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set meuble
     *
     * @param string $meuble
     *
     * @return Annonce_local
     */
    public function setMeuble($meuble)
    {
        $this->meuble = $meuble;

        return $this;
    }

    /**
     * Get meuble
     *
     * @return string
     */
    public function getMeuble()
    {
        return $this->meuble;
    }

    /**
     * Set placeParking
     *
     * @param integer $placeParking
     *
     * @return Annonce_local
     */
    public function setPlaceParking($placeParking)
    {
        $this->place_parking = $placeParking;

        return $this;
    }

    /**
     * Get placeParking
     *
     * @return integer
     */
    public function getPlaceParking()
    {
        return $this->place_parking;
    }

    /**
     * Set interphone
     *
     * @param boolean $interphone
     *
     * @return Annonce_local
     */
    public function setInterphone($interphone)
    {
        $this->interphone = $interphone;

        return $this;
    }

    /**
     * Get interphone
     *
     * @return boolean
     */
    public function getInterphone()
    {
        return $this->interphone;
    }

    /**
     * Set chauffeEau
     *
     * @param boolean $chauffeEau
     *
     * @return Annonce_local
     */
    public function setChauffeEau($chauffeEau)
    {
        $this->chauffe_eau = $chauffeEau;

        return $this;
    }

    /**
     * Get chauffeEau
     *
     * @return boolean
     */
    public function getChauffeEau()
    {
        return $this->chauffe_eau;
    }

    /**
     * Set balcon
     *
     * @param boolean $balcon
     *
     * @return Annonce_local
     */
    public function setBalcon($balcon)
    {
        $this->balcon = $balcon;

        return $this;
    }

    /**
     * Get balcon
     *
     * @return boolean
     */
    public function getBalcon()
    {
        return $this->balcon;
    }

    /**
     * Set cour
     *
     * @param boolean $cour
     *
     * @return Annonce_local
     */
    public function setCour($cour)
    {
        $this->cour = $cour;

        return $this;
    }

    /**
     * Get cour
     *
     * @return boolean
     */
    public function getCour()
    {
        return $this->cour;
    }

    /**
     * Set piscine
     *
     * @param boolean $piscine
     *
     * @return Annonce_local
     */
    public function setPiscine($piscine)
    {
        $this->piscine = $piscine;

        return $this;
    }

    /**
     * Get piscine
     *
     * @return boolean
     */
    public function getPiscine()
    {
        return $this->piscine;
    }

    /**
     * Set jardin
     *
     * @param boolean $jardin
     *
     * @return Annonce_local
     */
    public function setJardin($jardin)
    {
        $this->jardin = $jardin;

        return $this;
    }

    /**
     * Get jardin
     *
     * @return boolean
     */
    public function getJardin()
    {
        return $this->jardin;
    }

    /**
     * Set garage
     *
     * @param boolean $garage
     *
     * @return Annonce_local
     */
    public function setGarage($garage)
    {
        $this->garage = $garage;

        return $this;
    }

    /**
     * Get garage
     *
     * @return boolean
     */
    public function getGarage()
    {
        return $this->garage;
    }

    /**
     * Set parking
     *
     * @param boolean $parking
     *
     * @return Annonce_local
     */
    public function setParking($parking)
    {
        $this->parking = $parking;

        return $this;
    }

    /**
     * Get parking
     *
     * @return boolean
     */
    public function getParking()
    {
        return $this->parking;
    }

    /**
     * Set ascenseur
     *
     * @param boolean $ascenseur
     *
     * @return Annonce_local
     */
    public function setAscenseur($ascenseur)
    {
        $this->ascenseur = $ascenseur;

        return $this;
    }

    /**
     * Get ascenseur
     *
     * @return boolean
     */
    public function getAscenseur()
    {
        return $this->ascenseur;
    }

    /**
     * Set gardiennage
     *
     * @param boolean $gardiennage
     *
     * @return Annonce_local
     */
    public function setGardiennage($gardiennage)
    {
        $this->gardiennage = $gardiennage;

        return $this;
    }

    /**
     * Get gardiennage
     *
     * @return boolean
     */
    public function getGardiennage()
    {
        return $this->gardiennage;
    }

    /**
     * Set systemeAlarme
     *
     * @param boolean $systemeAlarme
     *
     * @return Annonce_local
     */
    public function setSystemeAlarme($systemeAlarme)
    {
        $this->systeme_alarme = $systemeAlarme;

        return $this;
    }

    /**
     * Get systemeAlarme
     *
     * @return boolean
     */
    public function getSystemeAlarme()
    {
        return $this->systeme_alarme;
    }

    /**
     * Set bordureRoute
     *
     * @param boolean $bordureRoute
     *
     * @return Annonce_local
     */
    public function setBordureRoute($bordureRoute)
    {
        $this->bordure_route = $bordureRoute;

        return $this;
    }

    /**
     * Get bordureRoute
     *
     * @return boolean
     */
    public function getBordureRoute()
    {
        return $this->bordure_route;
    }

    /**
     * Set vueLagune
     *
     * @param boolean $vueLagune
     *
     * @return Annonce_local
     */
    public function setVueLagune($vueLagune)
    {
        $this->vue_lagune = $vueLagune;

        return $this;
    }

    /**
     * Get vueLagune
     *
     * @return boolean
     */
    public function getVueLagune()
    {
        return $this->vue_lagune;
    }

    /**
     * Set vueMer
     *
     * @param boolean $vueMer
     *
     * @return Annonce_local
     */
    public function setVueMer($vueMer)
    {
        $this->vue_mer = $vueMer;

        return $this;
    }

    /**
     * Get vueMer
     *
     * @return boolean
     */
    public function getVueMer()
    {
        return $this->vue_mer;
    }

    /**
     * Set user
     *
     * @param \ImmoNotaire\ImmoNotaireBundle\Entity\User $user
     *
     * @return Annonce_local
     */
    public function setUser(\ImmoNotaire\ImmoNotaireBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ImmoNotaire\ImmoNotaireBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set annonce
     *
     * @param \ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce $annonce
     *
     * @return Annonce_local
     */
    public function setAnnonce(\ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce $annonce)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return \ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }

    /**
     * Set typeLocal
     *
     * @param \ImmoNotaire\ImmoAnnonceBundle\Entity\Type_local $typeLocal
     *
     * @return Annonce_local
     */
    public function setTypeLocal(\ImmoNotaire\ImmoAnnonceBundle\Entity\Type_local $typeLocal)
    {
        $this->type_local = $typeLocal;

        return $this;
    }

    /**
     * Get typeLocal
     *
     * @return \ImmoNotaire\ImmoAnnonceBundle\Entity\Type_local
     */
    public function getTypeLocal()
    {
        return $this->type_local;
    }
}
