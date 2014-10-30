<?php

namespace GEPedag\EntidadesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="especialidad", uniqueConstraints={@ORM\UniqueConstraint(name="nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class Especialidad {

    public function __toString() {
        return $this->nombre;
    }

    /**
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GEPedag\EntidadesBundle\Entity\Asignatura", inversedBy="especialidad")
     * @ORM\JoinTable(name="especialidad_asignatura",
     *   joinColumns={
     *     @ORM\JoinColumn(name="especialidad_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="asignatura_id", referencedColumnName="id")
     *   }
     * )
     */
    private $asignatura;

    /**
     * Constructor
     */
    public function __construct() {
        $this->asignatura = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Especialidad
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Add asignatura
     *
     * @param \GEPedag\EntidadesBundle\Entity\Asignatura $asignatura
     * @return Especialidad
     */
    public function addAsignatura(\GEPedag\EntidadesBundle\Entity\Asignatura $asignatura) {
        $this->asignatura[] = $asignatura;

        return $this;
    }

    /**
     * Remove asignatura
     *
     * @param \GEPedag\EntidadesBundle\Entity\Asignatura $asignatura
     */
    public function removeAsignatura(\GEPedag\EntidadesBundle\Entity\Asignatura $asignatura) {
        $this->asignatura->removeElement($asignatura);
    }

    /**
     * Get asignatura
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAsignatura() {
        return $this->asignatura;
    }

}
