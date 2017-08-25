<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24/11/2016
 * Time: 01:03
 */

namespace st\firstBundle\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\Mapping as ORM ;




class form extends AbstractType
{

    /**
     *
     * @ORM\Column(type="string",length=255)
     */
    protected $nom ;

    /**
     *
     * @ORM\Column(type="BigInt")
     */

    protected $population ;

    /**
     * @ORM\ManyToOne(targetEntity="st\firstBundle\Entity\continents")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $continent ;


    public function setNom($nom)
    {
        $this->nom = $nom ;
    }

    public function getNom()
    {
         return $this->nom ;
    }

    public function setPopulation($population)
    {
        $this->population = $population  ;
    }

    public function getPopulation()
    {
        return $this->population ;
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






public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('population')
            ->add('continent')
            ->add('save', SubmitType::class)

        ;
    }
}