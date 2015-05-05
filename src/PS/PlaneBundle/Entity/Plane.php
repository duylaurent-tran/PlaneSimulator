<?php

namespace PS\PlaneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use PS\PlaneBundle\Model\AbstractPlane;

/**
 * @ORM\Entity(repositoryClass="PS\PlaneBundle\Entity\PlaneRepository")
 */
class Plane extends AbstractPlane
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\Length(min="2", max="255")
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="currentLocationX", type="integer")
     */
    protected $currentLocationX;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="currentLocationY", type="integer")
     */
    protected $currentLocationY;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="remainingFuel", type="integer")
     */
    protected $remainingFuel;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="passengerCount", type="integer")
     */
    protected $passengerCount;

    /**
     * Exercise 3 only
     * TODO: Set the correct ORM mapping using annotations
     */
    protected $airport;

}
