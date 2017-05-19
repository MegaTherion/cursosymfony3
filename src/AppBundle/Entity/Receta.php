<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Receta
 *
 * @ORM\Table(name="receta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecetaRepository")
 */
class Receta
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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="dificultad", type="string", length=20)
     */
    private $dificultad;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(name="visto", type="integer")
     */
     private $visto;    

    /**
     * @ORM\ManyToOne(targetEntity="Autor")
     * @ORM\JoinColumn(name="autor_id", referencedColumnName="id")
     */
     private $autor;

    /**
     * @ORM\Column(type="string", length=200)
     *
     * @Assert\NotBlank(message="Por favor cargue una imagen.")
     * @Assert\Image()
     */
    private $brochure;


    public function getBrochure()
    {
        return $this->brochure;
    }

    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

        return $this;
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
     * @return Receta
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
     * Set dificultad
     *
     * @param string $dificultad
     *
     * @return Receta
     */
    public function setDificultad($dificultad)
    {
        $this->dificultad = $dificultad;

        return $this;
    }

    /**
     * Get dificultad
     *
     * @return string
     */
    public function getDificultad()
    {
        return $this->dificultad;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Receta
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set visto
     *
     * @param integer $visto
     *
     * @return Receta
     */
    public function setVisto($visto)
    {
        $this->visto = $visto;

        return $this;
    }

    /**
     * Get visto
     *
     * @return integer
     */
    public function getVisto()
    {
        return $this->visto;
    }

    /**
     * Set autor
     *
     * @param \AppBundle\Entity\Autor $autor
     *
     * @return Receta
     */
    public function setAutor(\AppBundle\Entity\Autor $autor = null)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return \AppBundle\Entity\Autor
     */
    public function getAutor()
    {
        return $this->autor;
    }
}
