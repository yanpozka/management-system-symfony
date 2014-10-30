<?php

namespace GEPedag\EntidadesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asignatura
 *
 * @ORM\Table(name="asignatura")
 * @ORM\Entity
 */
class Asignatura {

    public function __toString() {
        return $this->nombre;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GEPedag\EntidadesBundle\Entity\Estudiante", inversedBy="asignatura")
     * @ORM\JoinTable(name="estudiante_asignatura",
     *   joinColumns={
     *     @ORM\JoinColumn(name="asignatura_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="estudianteci", referencedColumnName="ci")
     *   }
     * )
     */
    private $estudianteci;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GEPedag\EntidadesBundle\Entity\Especialidad", mappedBy="asignatura")
     */
    private $especialidad;

    /**
     * Constructor
     */
    public function __construct() {
        $this->estudianteci = new \Doctrine\Common\Collections\ArrayCollection();
        $this->especialidad = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Asignatura
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
     * Add estudianteci
     *
     * @param \GEPedag\EntidadesBundle\Entity\Estudiante $estudianteci
     * @return Asignatura
     */
    public function addEstudianteci(\GEPedag\EntidadesBundle\Entity\Estudiante $estudianteci) {
        $this->estudianteci[] = $estudianteci;

        return $this;
    }

    /**
     * Remove estudianteci
     *
     * @param \GEPedag\EntidadesBundle\Entity\Estudiante $estudianteci
     */
    public function removeEstudianteci(\GEPedag\EntidadesBundle\Entity\Estudiante $estudianteci) {
        $this->estudianteci->removeElement($estudianteci);
    }

    /**
     * Get estudianteci
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstudianteci() {
        return $this->estudianteci;
    }

    /**
     * Add especialidad
     *
     * @param \GEPedag\EntidadesBundle\Entity\Especialidad $especialidad
     * @return Asignatura
     */
    public function addEspecialidad(\GEPedag\EntidadesBundle\Entity\Especialidad $especialidad) {
        $this->especialidad[] = $especialidad;

        return $this;
    }

    /**
     * Remove especialidad
     *
     * @param \GEPedag\EntidadesBundle\Entity\Especialidad $especialidad
     */
    public function removeEspecialidad(\GEPedag\EntidadesBundle\Entity\Especialidad $especialidad) {
        $this->especialidad->removeElement($especialidad);
    }

    /**
     * Get especialidad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEspecialidad() {
        return $this->especialidad;
    }

}
