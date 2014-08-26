<?php

namespace Mobility\PublicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Importation de la classe qui gère les contraintes de validation
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EcoActors
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mobility\PublicBundle\Entity\EcoActorsRepository")
 */
class EcoActors
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
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(message="Vous devez renseigner un titre.")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     * @Assert\NotNull(message="Veuillez rentrer selectionner un type de transport.")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="start", type="string", length=255)
     * @Assert\NotBlank(message="Vous devez renseigner une adresse de départ.")
     */
    private $start;

    /**
     * @var string
     *
     * @ORM\Column(name="arrival", type="string", length=255)
     * @Assert\NotBlank(message="Vous devez renseigner une adresse de destination.")
     */
    private $arrival;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank(message="Veuillez rentrer une description.")
     * @Assert\Length(
	 *	min=10,
	 *  max=500,
	 *  minMessage="Votre description doit comporter au moins {{ limit }} caractères.",
	 *  maxMessage="Votre description doit comporter {{ limit }} maximum.",
     * )
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="game", type="boolean")
     */
    private $game;



    /**
     * @ORM\ManyToOne(targetEntity="Mobility\PublicBundle\Entity\UserActor", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $useractor;
 

    

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
     * Set title
     *
     * @param string $title
     * @return EcoActors
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return EcoActors
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set start
     *
     * @param string $start
     * @return EcoActors
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return string 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set arrival
     *
     * @param string $arrival
     * @return EcoActors
     */
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;

        return $this;
    }

    /**
     * Get arrival
     *
     * @return string 
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return EcoActors
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set game
     *
     * @param boolean $game
     * @return EcoActors
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


    /**
     * Set useractor
     *
     * @param \Mobility\PublicBundle\Entity\UserActor $useractor
     * @return EcoActors
     */
    public function setUseractor(\Mobility\PublicBundle\Entity\UserActor $useractor)
    {
        $this->useractor = $useractor;

        return $this;
    }

    /**
     * Get useractor
     *
     * @return \Mobility\PublicBundle\Entity\UserActor 
     */
    public function getUseractor()
    {
        return $this->useractor;
    }

    /**
     * Delete useractor
     *
     * @return \Mobility\PublicBundle\Entity\UserActor 
     */
    public function deleteUseractor()
    {
        unset($this->useractor);
    }


}
