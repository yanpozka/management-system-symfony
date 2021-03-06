<?php

namespace GEPedag\EntidadesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="clase_estudiante", uniqueConstraints={@ORM\UniqueConstraint(name="nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class ClaseEstudiante {

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
     * Set nombre
     *
     * @param string $nombre
     * @return ClaseEstudiante
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

}
