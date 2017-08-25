<?php

namespace st\firstBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


use Doctrine\ORM\Mapping as ORM;

/**
 * continents
 *
 * @ORM\Table(name="continents")
 * @ORM\Entity(repositoryClass="st\firstBundle\Repository\continentsRepository")
 * @UniqueEntity(fields="nom" , message="this continent already exisits")
 */
class continents
{
    /**
     *
     * @ORM\OneToMany(targetEntity="st\firstBundle\Entity\pays",cascade={"remove"},
     * mappedBy="continent")
     */
     private $pays ;

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
     * @Assert\Length(min=3 ,minMessage = "Your first name must be at least {{ limit }} characters long",)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="population", type="bigint")
     */
    private $population=0;

public function increasePopulation( $populationPays)
{
    $this->population+= $populationPays ;
}

public function decreasePopulation( $populationPays)
{
    $this->population-= $populationPays ;
}


  //ma fhimtich 3lééh ma 7abitch ti5dm ,,, é_é
    /*

  public function populationUpdate1($populationPays)
{
    $this->population -= $populationPays ;
}

public function populationUpdate2($populationPays)
  {
      $this->population += $populationPays ;
  }
     */


    public function getPopSum()
    {
        $popSum=0 ;
        foreach( $this->pays as $pays)
            $popSum+= $pays->getPopulation() ;
        return $popSum ;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="nbrPays", type="smallint")
     */
    private $nbrPays=0 ;

public function increaseNbrPays()
{
    $this->nbrPays++ ;
}

public function decreaseNbrPays()
{
    $this->nbrPays-- ;
}



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
     * @return continents
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
     * @return continents
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
     * Set nbrPays
     *
     * @param integer $nbrPays
     *
     * @return continents
     */
    public function setNbrPays($nbrPays)
    {
        $this->nbrPays = $nbrPays;

        return $this;
    }

    /**
     * Get nbrPays
     *
     * @return int
     */
    public function getNbrPays()
    {
        return $this->nbrPays;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pays = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pay
     *
     * @param \st\firstBundle\Entity\pays $pay
     *
     * @return continents
     */
    public function addPay(\st\firstBundle\Entity\pays $pay)
    {
        $this->pays[] = $pay;

        return $this;
    }

    /**
     * Remove pay
     *
     * @param \st\firstBundle\Entity\pays $pay
     */
    public function removePay(\st\firstBundle\Entity\pays $pay)
    {
        $this->pays->removeElement($pay);
    }

    /**
     * Get pays
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPays()
    {
        return $this->pays;
    }
}
