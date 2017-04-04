<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="ImmoNotaire\ImmoAnnonceBundle\Repository\MediaRepository")
 */
class Media
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
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png", "image/jpg", })
     * @Assert\File(maxSize="6000000")
     * @Assert\blank()
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png", "image/jpg", })
     * @Assert\File(maxSize="6000000")
     * @Assert\blank()
     */
    private $file1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png", "image/jpg", })
     * @Assert\File(maxSize="6000000")
     * @Assert\blank()
     */
    private $file2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png", "image/jpg", })
     * @Assert\File(maxSize="6000000")
     * @Assert\blank()
     */
    private $file3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png", "image/jpg", })
     * @Assert\File(maxSize="6000000")
     * @Assert\blank()
     */
    private $file4;



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
     * Set file
     *
     * @param string $file
     *
     * @return Media
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set file1
     *
     * @param string $file1
     *
     * @return Media
     */
    public function setFile1($file1)
    {
        $this->file1 = $file1;

        return $this;
    }

    /**
     * Get file1
     *
     * @return string
     */
    public function getFile1()
    {
        return $this->file1;
    }

    /**
     * Set file2
     *
     * @param string $file2
     *
     * @return Media
     */
    public function setFile2($file2)
    {
        $this->file2 = $file2;

        return $this;
    }

    /**
     * Get file2
     *
     * @return string
     */
    public function getFile2()
    {
        return $this->file2;
    }

    /**
     * Set file3
     *
     * @param string $file3
     *
     * @return Media
     */
    public function setFile3($file3)
    {
        $this->file3 = $file3;

        return $this;
    }

    /**
     * Get file3
     *
     * @return string
     */
    public function getFile3()
    {
        return $this->file3;
    }

    /**
     * Set file4
     *
     * @param string $file4
     *
     * @return Media
     */
    public function setFile4($file4)
    {
        $this->file4 = $file4;

        return $this;
    }

    /**
     * Get file4
     *
     * @return string
     */
    public function getFile4()
    {
        return $this->file4;
    }
}
