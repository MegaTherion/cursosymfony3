<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Autor
 *
 * @ORM\Table(name="autor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AutorRepository")
 */
class Autor
{
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
     * @ORM\Column(name="nombre", type="string", length=50)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $nombre;

    /**
     * @ORM\Column(name="apellido", type="string", length=255)
     */
     private $apellido;

    /**
     * @ORM\Column(name="fecha_nac", type="date")
     */
     private $fechaNac;

    /**
     * @ORM\Column(name="edad", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 16,
     *      max = 70,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     * )
     */
     private $edad;

    /**
     * @Assert\IsTrue(message = "The password cannot match your first name")
     */
    public function isPasswordLegal()
    {
        return $this->nombre != $this->apellido;
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Autor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set fechaNac
     *
     * @param \DateTime $fechaNac
     *
     * @return Autor
     */
    public function setFechaNac($fechaNac)
    {
        $this->fechaNac = $fechaNac;

        return $this;
    }

    /**
     * Get fechaNac
     *
     * @return \DateTime
     */
    public function getFechaNac()
    {
        return $this->fechaNac;
    }

    public function __toString() {
        return $this->nombre;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return Autor
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Autor
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }
}
