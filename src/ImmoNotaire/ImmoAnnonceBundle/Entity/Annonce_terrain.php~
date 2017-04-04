<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Annonce_terrain
 *
 * @ORM\Table(name="annonce_terrain")
 * @ORM\Entity(repositoryClass="ImmoNotaire\ImmoAnnonceBundle\Repository\Annonce_terrainRepository")
 */
class Annonce_terrain
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
     * @ORM\ManyToOne(targetEntity="ImmoNotaire\ImmoNotaireBundle\Entity\User", inversedBy="annonce_terrain")
     */
    private $user;


    /**
     * @ORM\OneToOne(targetEntity="ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce",cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;

     /**
     * @ORM\ManyToOne(targetEntity="ImmoNotaire\ImmoAnnonceBundle\Entity\Type_terrain",cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $type_terrain;

    /**
     * @var string
     * 
     *  @Assert\Type(
     *     type="integer",
     *     message="cette valeur doit être un nombre."
     * )
     *
     * @ORM\Column(name="superficie", type="string", length=255, nullable=true)
     */
    private $superficie;

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
     * @return Annonce_terrain
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
     * Set user
     *
     * @param \ImmoNotaire\ImmoNotaireBundle\Entity\User $user
     *
     * @return Annonce_terrain
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
     * @return Annonce_terrain
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
     * Set typeTerrain
     *
     * @param \ImmoNotaire\ImmoAnnonceBundle\Entity\Type_terrain $typeTerrain
     *
     * @return Annonce_terrain
     */
    public function setTypeTerrain(\ImmoNotaire\ImmoAnnonceBundle\Entity\Type_terrain $typeTerrain)
    {
        $this->type_terrain = $typeTerrain;

        return $this;
    }

    /**
     * Get typeTerrain
     *
     * @return \ImmoNotaire\ImmoAnnonceBundle\Entity\Type_terrain
     */
    public function getTypeTerrain()
    {
        return $this->type_terrain;
    }
}
