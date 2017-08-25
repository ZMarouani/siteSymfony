<?php

namespace st\dataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * chat
 *
 * @ORM\Table(name="chat")
 * @ORM\Entity(repositoryClass="st\dataBundle\Repository\chatRepository")
 */
class chat
{
    /**
     * @ORM\ManyToOne(targetEntity="st\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

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
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time")
     */
    private $time;


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
     * Set message
     *
     * @param string $message
     *
     * @return chat
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return chat
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set user
     *
     * @param \st\UserBundle\Entity\User $user
     *
     * @return chat
     */
    public function setUser(\st\UserBundle\Entity\User $user)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \st\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }
}
