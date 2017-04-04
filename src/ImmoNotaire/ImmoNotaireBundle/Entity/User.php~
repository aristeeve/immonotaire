<?php

namespace ImmoNotaire\ImmoNotaireBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="etude", type="string", length=255 )
     * @Assert\NotBlank(message="Please enter your name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",)
     */
    protected $etude;

    /**
     * @ORM\Column(name="siege",type="string" , length= 255, nullable= true)
     */
    protected $siege;

    /**
     * @ORM\Column(name="personneAContacter", type="string" , length= 255, nullable= true)
     * @Assert\NotBlank(message="Please complete this field.")
     */
    protected $personneAContacter;

    /**
     * @ORM\Column(name="contact", type="string" , length= 255, nullable = true)
     * @Assert\NotBlank(message="Please complete this field.")
     */
    protected $contact;

    /**
     * @ORM\Column(name="telephone", type="string" , length= 255, nullable = true)
     */
    protected $telephone;

    /**
     * @ORM\Column(name="telecopie", type="string" , length= 255, nullable = true)
     */
    protected $telecopie;

    /**
     * @var bool
     * 
     * @ORM\Column(name="admin", type="boolean" , nullable = true)
     */
    protected $admin;

    /**
     * @ORM\Column(name="name", type="string" , nullable = true)
     */
    protected $name;
    
    /**
     * @ORM\Column(name="firstname", type="string" , nullable = true)
     */
    protected $firstname;

    /**
     * @ORM\Column(name="ville", type="string" , nullable = true)
     */
    protected $ville;

    /**
     * @var bool
     * 
     * @ORM\Column(name="premium", type="boolean" , nullable = true)
     */
    protected $premium;

    public function __construct() {
        parent::__construct();
        $this->annonce_appart = new \Doctrine\Common\Collections\ArrayCollection();
        $this->annonce_local = new \Doctrine\Common\Collections\ArrayCollection();
        $this->annonce_maison = new \Doctrine\Common\Collections\ArrayCollection();
        $this->annonce_terrain = new \Doctrine\Common\Collections\ArrayCollection();
        $this->admin = 0;
        $this->premium = 0;
    }

    /**
     * @ORM\OneToMany(targetEntity="ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_appart", mappedBy="user", cascade={"remove"})
     */
    private $annonce_appart;

    /**
     * @ORM\OneToMany(targetEntity="ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_local", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $annonce_local;

    /**
     * @ORM\OneToMany(targetEntity="ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_maison", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $annonce_maison;

    /**
     * @ORM\OneToMany(targetEntity="ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_terrain", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $annonce_terrain;

    /**
     * Set etude
     *
     * @param string $etude
     *
     * @return User
     */
    public function setEtude($etude) {
        $this->etude = $etude;

        return $this;
    }

    /**
     * Get etude
     *
     * @return string
     */
    public function getEtude() {
        return $this->etude;
    }

    /**
     * Set siege
     *
     * @param string $siege
     *
     * @return User
     */
    public function setSiege($siege) {
        $this->siege = $siege;

        return $this;
    }

    /**
     * Get siege
     *
     * @return string
     */
    public function getSiege() {
        return $this->siege;
    }

    /**
     * Set personneAContacter
     *
     * @param string $personneAContacter
     *
     * @return User
     */
    public function setPersonneAContacter($personneAContacter) {
        $this->personneAContacter = $personneAContacter;

        return $this;
    }

    /**
     * Get personneAContacter
     *
     * @return string
     */
    public function getPersonneAContacter() {
        return $this->personneAContacter;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return User
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone() {
        return $this->telephone;
    }

    /**
     * Set telecopie
     *
     * @param string $telecopie
     *
     * @return User
     */
    public function setTelecopie($telecopie) {
        $this->telecopie = $telecopie;

        return $this;
    }

    /**
     * Get telecopie
     *
     * @return string
     */
    public function getTelecopie() {
        return $this->telecopie;
    }

    /**
     * Add annonceAppart
     *
     * @param \ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_appart $annonceAppart
     *
     * @return User
     */
    public function addAnnonceAppart(\ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_appart $annonceAppart) {
        $this->annonce_appart[] = $annonceAppart;

        return $this;
    }

    /**
     * Remove annonceAppart
     *
     * @param \ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_appart $annonceAppart
     */
    public function removeAnnonceAppart(\ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_appart $annonceAppart) {
        $this->annonce_appart->removeElement($annonceAppart);
    }

    /**
     * Get annonceAppart
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnonceAppart() {
        return $this->annonce_appart;
    }

    /**
     * Add annonceLocal
     *
     * @param \ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_local $annonceLocal
     *
     * @return User
     */
    public function addAnnonceLocal(\ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_local $annonceLocal) {
        $this->annonce_local[] = $annonceLocal;

        return $this;
    }

    /**
     * Remove annonceLocal
     *
     * @param \ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_local $annonceLocal
     */
    public function removeAnnonceLocal(\ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_local $annonceLocal) {
        $this->annonce_local->removeElement($annonceLocal);
    }

    /**
     * Get annonceLocal
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnonceLocal() {
        return $this->annonce_local;
    }

    /**
     * Add annonceMaison
     *
     * @param \ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_maison $annonceMaison
     *
     * @return User
     */
    public function addAnnonceMaison(\ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_maison $annonceMaison) {
        $this->annonce_maison[] = $annonceMaison;

        return $this;
    }

    /**
     * Remove annonceMaison
     *
     * @param \ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_maison $annonceMaison
     */
    public function removeAnnonceMaison(\ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_maison $annonceMaison) {
        $this->annonce_maison->removeElement($annonceMaison);
    }

    /**
     * Get annonceMaison
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnonceMaison() {
        return $this->annonce_maison;
    }

    /**
     * Add annonceTerrain
     *
     * @param \ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_terrain $annonceTerrain
     *
     * @return User
     */
    public function addAnnonceTerrain(\ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_terrain $annonceTerrain) {
        $this->annonce_terrain[] = $annonceTerrain;

        return $this;
    }

    /**
     * Remove annonceTerrain
     *
     * @param \ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_terrain $annonceTerrain
     */
    public function removeAnnonceTerrain(\ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_terrain $annonceTerrain) {
        $this->annonce_terrain->removeElement($annonceTerrain);
    }

    /**
     * Get annonceTerrain
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnonceTerrain() {
        return $this->annonce_terrain;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return User
     */
    public function setContact($contact) {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact() {
        return $this->contact;
    }

    /**
     * Set admin
     *
     * @param boolean $admin
     *
     * @return User
     */
    public function setAdmin($admin) {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return boolean
     */
    public function getAdmin() {
        return $this->admin;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville) {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille() {
        return $this->ville;
    }

    /**
     * Set premium
     *
     * @param boolean $premium
     *
     * @return User
     */
    public function setPremium($premium) {
        $this->premium = $premium;

        return $this;
    }

    /**
     * Get premium
     *
     * @return boolean
     */
    public function getPremium() {
        return $this->premium;
    }


    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
}
