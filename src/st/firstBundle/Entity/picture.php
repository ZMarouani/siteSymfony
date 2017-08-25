<?php

namespace st\firstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="st\firstBundle\Repository\pictureRepository")
 */
class picture
{
//    /**
//     * @ORM\OneToOne(targetEntity="st\firstBundle\Entity\pays" , mappedBy="pays")
//     * @ORM\JoinColumn(nullable=false)
//     */
//    public $pays;
//

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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;


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
     * Set url
     *
     * @param string $url
     *
     * @return picture
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return picture
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }


    public  $file ;
    public function setFile(UploadedFile $file = null)
    {
        $this->file=$file ;
    }
    public function getFile()
    {
        return $this->file;
    }

    public function upload( )
    {
        if (null== $this->file) {
            return ;
        }
        $name=$this->file->getClientOriginalName() ;
        $this->file->move($this->getUploadedRootDir(), $name) ;
        $this->url = $name ;
        $this->alt= $name ;


    }

    public function getUploadedDir()
    {
        return 'uploads/img' ;

    }

    protected function getUploadedRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadedDir() ;

    }

//    /**
//     * Set pays
//     *
//     * @param \st\firstBundle\Entity\pays $pays
//     *
//     * @return picture
//     */
//    public function setPays(\st\firstBundle\Entity\pays $pays)
//    {
//        $this->pays = $pays;
//
//        return $this;
//    }
//
//    /**
//     * Get pays
//     *
//     * @return \st\firstBundle\Entity\pays
//     */
//    public function getPays()
//    {
//        return $this->pays;
//    }
}
