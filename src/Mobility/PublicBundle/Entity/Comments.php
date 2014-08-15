<?php

namespace Mobility\PublicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Importation de la classe qui gère les contraintes de validation
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comments
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mobility\PublicBundle\Entity\CommentsRepository")
 */
class Comments
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
     * @Assert\NotBlank(message="Vous devez renseigner votre adresse email.")
     * @Assert\Email(message="Votre email n'est pas valide.")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     * @Assert\NotBlank(message="Veuillez rentrer une description.")
     * @Assert\Length(
	 *	min=5,
	 *  max=500,
	 *  minMessage="Votre message doit comporter au moins {{ limit }} caractères.",
	 *  maxMessage="Votre message doit comporter {{ limit }} maximum.",
     * )
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="spam", type="string", length=255)
     */
    private $spam;

    /**
     * @ORM\ManyToOne(targetEntity="Mobility\PublicBundle\Entity\EcoActors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ecoactor;


 

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
     * @return Comments
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
     * Set message
     *
     * @param string $message
     * @return Comments
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
     * Set status
     *
     * @param string $status
     * @return Comments
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set spam
     *
     * @param string $spam
     * @return Comments
     */
    public function setSpam($spam)
    {
        $this->spam = $spam;

        return $this;
    }

    /**
     * Get spam
     *
     * @return string 
     */
    public function getSpam()
    {
        return $this->spam;
    }

    /**
     * Set ecoactor
     *
     * @param \Mobility\PublicBundle\Entity\EcoActors $ecoactor
     * @return Comments
     */
    public function setEcoactor(\Mobility\PublicBundle\Entity\EcoActors $ecoactor)
    {
        $this->ecoactor = $ecoactor;

        return $this;
    }

    /**
     * Get ecoactor
     *
     * @return \Mobility\PublicBundle\Entity\EcoActors 
     */
    public function getEcoactor()
    {
        return $this->ecoactor;
    }
}
