<?php

namespace st\firstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass="st\firstBundle\Repository\paysRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="nom" , message="this country already exists" )
 */
class pays
{

    /**
     * @ORM\OneToOne(targetEntity="st\firstBundle\Entity\picture" , cascade={"persist"})
     */
    public $picture;


    /**
     * @ORM\PrePersist
     */
    public function increase()
    {
        $this->getContinent()->increaseNbrPays() ;
    }


    /**
     * @ORM\PrePersist
     */
    public function increasePopulation()
    {
        $this->getContinent()->increasePopulation( $this->population) ;
    }



    /**
     * @ORM\PreRemove
     */

    public function decrease()
    {
        $this->getContinent()->decreaseNbrPays() ;
    }

    /**
     * @ORM\PreRemove
     */
    public function decreasePopulation()
    {
        $this->getContinent()->decreasePopulation($this->population) ;
    }



     /**
     * @ORM\PreUpdate
     */
     /*
      public function populationUpdate11()
    {
        $this->getContinent()->populationUpdate1($this->population) ;
    }

    /**
     * @ORM\PostUpdate
     */
    /*
    public function populationUpdate12()
    {
        $this->getContinent()->populationUpdate2($this->population) ;
    }
    */



    /**
     * @ORM\ManyToOne(targetEntity="st\firstBundle\Entity\continents",
     inversedBy="continents" )
     * @ORM\JoinColumn(nullable=false)
     */
    private $continent ;

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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     * @Assert\Length(min=3, minMessage="le nom du pays est 3 caracters au min !!")
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="population", type="bigint")
     */
    private $population;


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
     * @return pays
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
     * Set population
     *
     * @param integer $population
     *
     * @return pays
     */
    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }

    /**
     * Get population
     *
     * @return int
     */
    public function getPopulation()
    {
        return $this->population;
    }


    /**
     * Set continent
     *
     * @param \st\firstBundle\Entity\continents $continent
     *
     * @return pays
     */
    public function setContinent(\st\firstBundle\Entity\continents $continent)
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * Get continent
     *
     * @return \st\firstBundle\Entity\continents
     */
    public function getContinent()
    {
        return $this->continent;
    }


    /**
     * Set picture
     *
     * @param \st\firstBundle\Entity\picture $picture
     *
     * @return pays
     */
    public function setPicture(\st\firstBundle\Entity\picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \st\firstBundle\Entity\picture
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
