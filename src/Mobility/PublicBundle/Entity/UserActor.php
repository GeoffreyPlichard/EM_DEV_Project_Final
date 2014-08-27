<?php

namespace Mobility\PublicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserActor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mobility\PublicBundle\Entity\UserActorRepository")
 */
class UserActor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var float
     *
     * @ORM\Column(name="gestotal", type="float")
     */
    private $gestotal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="game", type="boolean")
     */
    private $game;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return UserActor
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set gestotal
     *
     * @param integer $gestotal
     * @return UserActor
     */
    public function setGestotal($gestotal)
    {
        $this->gestotal = $gestotal;

        return $this;
    }

    /**
     * Get gestotal
     *
     * @return integer 
     */
    public function getGestotal()
    {
        return $this->gestotal;
    }

    /**
     * Set game
     *
     * @param boolean $game
     * @return UserActor
     */
    public function setGame($game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return boolean 
     */
    public function getGame()
    {
        return $this->game;
    }
}
