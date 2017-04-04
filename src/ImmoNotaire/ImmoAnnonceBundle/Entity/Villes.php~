<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Regions;

/**
 * Villes
 *
 * @ORM\Table(name="villes")
 * @ORM\Entity(repositoryClass="ImmoNotaire\ImmoAnnonceBundle\Repository\VillesRepository")
 */
class Villes
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
        
 
    
    


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Villes
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
     * Set regions
     *
     * @param ImmoNotaire\ImmoAnnonceBundle\Entity\Regions $regions
     *
     * @return Villes
     */
    public function setRegions(Regions $regions = null)
    {
        $this->regions = $regions;

        return $this;
    }

    /**
     * Get regions
     *
     * @return ImmoNotaire\ImmoAnnonceBundle\Entity\Regions
     */
    public function getRegions()
    {
        return $this->regions;
    }
}
