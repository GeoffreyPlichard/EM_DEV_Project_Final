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
     * @var integer
     *
     * @ORM\Column(name="ges", type="integer")
     */
    private $ges;


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
     * Set ges
     *
     * @param integer $ges
     * @return UserActor
     */
    public function setGes($ges)
    {
        $this->ges = $ges;

        return $this;
    }

    /**
     * Get ges
     *
     * @return integer 
     */
    public function getGes()
    {
        return $this->ges;
    }
}
