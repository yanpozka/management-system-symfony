<?php

namespace GEPedag\EntidadesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

//@ORM\HasLifecycleCallbacks
/**
 * @ORM\Table(name="estudiante", indexes={@ORM\Index(name="FKestudiante248635", columns={"tipo_plan_id"}),
 * @ORM\Index(name="FKestudiante563852", columns={"fuente_ingreso_id"}), @ORM\Index(name="FKestudiante336072",columns={"especialidad_id"}), @ORM\Index(name="FKestudiante131194", columns={"provincia_id"}),
 * @ORM\Index(name="FKestudiante64100", columns={"municipio_id"}), @ORM\Index(name="FKestudiante434717",columns={"clase_estudiante_id"}), @ORM\Index(name="FKestudiante865491", columns={"procedencia_escolar_id"}),
 * @ORM\Index(name="FKestudiante420914", columns={"procedencia_papa_id"}), @ORM\Index(name="FKestudiante570648",columns={"procedencia_madre_id"}), @ORM\Index(name="FKestudiante1336", columns={"codigo_baja_id"})})
 * @ORM\Entity(repositoryClass="GEPedag\EntidadesBundle\Entity\EstudianteRepository")
 */
class Estudiante
{
    public function __toString()
    {
        return $this->nombres . " " . $this->primerApellido . " " . $this->segundoApellido;
    }

    /**
     * @ORM\Column(name="primer_apellido", type="string", length=255, nullable=false)
     */
    private $primerApellido;

    /**
     * @ORM\Column(name="nombres", type="string", length=255, nullable=false)
     */
    private $nombres;

    /**
     * @ORM\Column(name="segundo_apellido", type="string", length=255, nullable=false)
     */
    private $segundoApellido;

    /**
     * @ORM\Column(name="telefono", type="string", length=30, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(name="color_piel", type="string", nullable=false)
     */
    private $colorPiel;

    /**
     * @ORM\Column(name="direccion", type="string", length=255, nullable=false)
     */
    private $direccion;

    /**
     * @ORM\Column(name="fecha_ingr_educ_sup", type="date", nullable=false)
     * @Assert\Date()
     */
    private $fechaIngrEducSup;

    /**
     * @ORM\Column(name="fecha_ingr_isp", type="date", nullable=false)
     * @Assert\Date()
     */
    private $fechaIngrIsp;

    /**
     * @ORM\Column(name="fecha_ingr_esp", type="date", nullable=false)
     * @Assert\Date()
     */
    private $fechaIngrEsp;

    /**
     * @ORM\Column(name="org_politica", type="string", nullable=true)
     */
    private $orgPolitica;

    /**
     * @ORM\Column(name="anio_estudio", type="integer", nullable=false)
     */
    private $anioEstudio;

    /**
     * @ORM\Column(name="sede", type="string", length=255, nullable=true)
     */
    private $sede;
    
    /**
     * @ORM\Column(name="baja", type="boolean", nullable=true)
     */
    private $baja;
    
    /**
     * @ORM\Column(name="alta", type="boolean", nullable=true)
     */
    private $alta;

    /**
     * @ORM\Column(name="ci", type="string", length=11)
     * @ORM\Id
     * @Assert\NotBlank()
     * @Assert\Length(min=11, max=11)
     */
    private $ci;

    /**
     * @var FuenteIngreso
     *
     * @ORM\ManyToOne(targetEntity="GEPedag\EntidadesBundle\Entity\FuenteIngreso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fuente_ingreso_id", referencedColumnName="id")
     * })
     */
    private $fuenteIngreso;

    /**
     * @var \GEPedag\EntidadesBundle\Entity\ProcedenciaPadres
     *
     * @ORM\ManyToOne(targetEntity="GEPedag\EntidadesBundle\Entity\ProcedenciaPadres")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="procedencia_madre_id", referencedColumnName="id")
     * })
     */
    private $procedenciaMadre;

    /**
     * @var \GEPedag\EntidadesBundle\Entity\Municipio
     *
     * @ORM\ManyToOne(targetEntity="GEPedag\EntidadesBundle\Entity\Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="municipio_id", referencedColumnName="id")
     * })
     */
    private $municipio;

    /**
     * @var \GEPedag\EntidadesBundle\Entity\ProcedenciaEscolar
     *
     * @ORM\ManyToOne(targetEntity="GEPedag\EntidadesBundle\Entity\ProcedenciaEscolar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="procedencia_escolar_id", referencedColumnName="id")
     * })
     */
    private $procedenciaEscolar;

    /**
     * @var \GEPedag\EntidadesBundle\Entity\Provincia
     *
     * @ORM\ManyToOne(targetEntity="GEPedag\EntidadesBundle\Entity\Provincia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     * })
     */
    private $provincia;

    /**
     * @var \GEPedag\EntidadesBundle\Entity\ClaseEstudiante
     *
     * @ORM\ManyToOne(targetEntity="GEPedag\EntidadesBundle\Entity\ClaseEstudiante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clase_estudiante_id", referencedColumnName="id")
     * })
     */
    private $claseEstudiante;

    /**
     * @var \GEPedag\EntidadesBundle\Entity\CodigoBaja
     *
     * @ORM\ManyToOne(targetEntity="GEPedag\EntidadesBundle\Entity\CodigoBaja")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codigo_baja_id", referencedColumnName="id")
     * })
     */
    private $codigoBaja;

    /**
     * @var \GEPedag\EntidadesBundle\Entity\ProcedenciaPadres
     *
     * @ORM\ManyToOne(targetEntity="GEPedag\EntidadesBundle\Entity\ProcedenciaPadres")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="procedencia_papa_id", referencedColumnName="id")
     * })
     */
    private $procedenciaPapa;

    /**
     * @var \GEPedag\EntidadesBundle\Entity\TipoPlan
     *
     * @ORM\ManyToOne(targetEntity="GEPedag\EntidadesBundle\Entity\TipoPlan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_plan_id", referencedColumnName="id")
     * })
     */
    private $tipoPlan;

    /**
     * @var \GEPedag\EntidadesBundle\Entity\Especialidad
     *
     * @ORM\ManyToOne(targetEntity="GEPedag\EntidadesBundle\Entity\Especialidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="especialidad_id", referencedColumnName="id")
     * })
     */
    private $especialidad;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GEPedag\EntidadesBundle\Entity\Asignatura", mappedBy="estudianteci")
     */
    private $asignatura;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->asignatura = new ArrayCollection();
    }

    public function getSexo()
    {
        $sexo = substr($this->ci, 10, strlen($this->ci));
        return ($sexo % 2 == 0) ? 'masculino' : 'femenino';
    }

    public function setCi($ci)
    {
        $this->ci = $ci;
        return $this;
    }

    public function getCi()
    {
        return $this->ci;
    }

    /**
     * Set primerApellido
     *
     * @param string $primerApellido
     * @return Estudiante
     */
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get primerApellido
     *
     * @return string
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     * @return Estudiante
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     * @return Estudiante
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return string
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * @param string $telefono
     * @return Estudiante
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param $colorPiel
     * @return Estudiante
     */
    public function setColorPiel($colorPiel)
    {
        $this->colorPiel = $colorPiel;

        return $this;
    }

    /**
     * @return array
     */
    public function getColorPiel()
    {
        return $this->colorPiel;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Estudiante
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param \DateTime $fechaIngrEducSup
     * @return Estudiante
     */
    public function setFechaIngrEducSup($fechaIngrEducSup)
    {
        $this->fechaIngrEducSup = $fechaIngrEducSup;
        return $this;
    }

    /**
     * Get fechaIngrEducSup
     *
     * @return \DateTime
     */
    public function getFechaIngrEducSup()
    {
        return $this->fechaIngrEducSup;
    }

    /**
     * Set fechaIngrIsp
     *
     * @param \DateTime $fechaIngrIsp
     * @return Estudiante
     */
    public function setFechaIngrIsp($fechaIngrIsp)
    {
        $this->fechaIngrIsp = $fechaIngrIsp;

        return $this;
    }

    /**
     * Get fechaIngrIsp
     *
     * @return \DateTime
     */
    public function getFechaIngrIsp()
    {
        return $this->fechaIngrIsp;
    }

    /**
     * Set fechaIngrEsp
     *
     * @param \DateTime $fechaIngrEsp
     * @return Estudiante
     */
    public function setFechaIngrEsp($fechaIngrEsp)
    {
        $this->fechaIngrEsp = $fechaIngrEsp;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaIngrEsp()
    {
        return $this->fechaIngrEsp;
    }

    /**
     * @param $orgPolitica
     * @return Estudiante
     */
    public function setOrgPolitica($orgPolitica)
    {
        $this->orgPolitica = $orgPolitica;

        return $this;
    }

    /**
     * @return array
     */
    public function getOrgPolitica()
    {
        return $this->orgPolitica;
    }

    /**
     * Set anioEstudio
     *
     * @param integer $anioEstudio
     * @return Estudiante
     */
    public function setAnioEstudio($anioEstudio)
    {
        $this->anioEstudio = $anioEstudio;

        return $this;
    }

    /**
     * @return integer
     */
    public function getAnioEstudio()
    {
        return $this->anioEstudio;
    }

    /**
     * @param string $sede
     * @return Estudiante
     */
    public function setSede($sede)
    {
        $this->sede = $sede;
        return $this;
    }

    /**
     * @return string
     */
    public function getSede()
    {
        return $this->sede;
    }

    /**
     * Set fuenteIngreso
     *
     * @param FuenteIngreso $fuenteIngreso
     * @return Estudiante
     */
    public function setFuenteIngreso(FuenteIngreso $fuenteIngreso = null)
    {
        $this->fuenteIngreso = $fuenteIngreso;
        return $this;
    }

    /**
     * Get fuenteIngreso
     *
     * @return FuenteIngreso
     */
    public function getFuenteIngreso()
    {
        return $this->fuenteIngreso;
    }

    /**
     * Set procedenciaMadre
     *
     * @param \GEPedag\EntidadesBundle\Entity\ProcedenciaPadres $procedenciaMadre
     * @return Estudiante
     */
    public function setProcedenciaMadre(\GEPedag\EntidadesBundle\Entity\ProcedenciaPadres $procedenciaMadre = null)
    {
        $this->procedenciaMadre = $procedenciaMadre;

        return $this;
    }

    /**
     * Get procedenciaMadre
     *
     * @return \GEPedag\EntidadesBundle\Entity\ProcedenciaPadres
     */
    public function getProcedenciaMadre()
    {
        return $this->procedenciaMadre;
    }

    /**
     * Set municipio
     *
     * @param \GEPedag\EntidadesBundle\Entity\Municipio $municipio
     * @return Estudiante
     */
    public function setMunicipio(\GEPedag\EntidadesBundle\Entity\Municipio $municipio = null)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get municipio
     *
     * @return \GEPedag\EntidadesBundle\Entity\Municipio
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set procedenciaEscolar
     *
     * @param \GEPedag\EntidadesBundle\Entity\ProcedenciaEscolar $procedenciaEscolar
     * @return Estudiante
     */
    public function setProcedenciaEscolar(\GEPedag\EntidadesBundle\Entity\ProcedenciaEscolar $procedenciaEscolar = null)
    {
        $this->procedenciaEscolar = $procedenciaEscolar;

        return $this;
    }

    /**
     * Get procedenciaEscolar
     *
     * @return \GEPedag\EntidadesBundle\Entity\ProcedenciaEscolar
     */
    public function getProcedenciaEscolar()
    {
        return $this->procedenciaEscolar;
    }

    /**
     * Set provincia
     *
     * @param \GEPedag\EntidadesBundle\Entity\Provincia $provincia
     * @return Estudiante
     */
    public function setProvincia(\GEPedag\EntidadesBundle\Entity\Provincia $provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \GEPedag\EntidadesBundle\Entity\Provincia
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set claseEstudiante
     *
     * @param \GEPedag\EntidadesBundle\Entity\ClaseEstudiante $claseEstudiante
     * @return Estudiante
     */
    public function setClaseEstudiante(\GEPedag\EntidadesBundle\Entity\ClaseEstudiante $claseEstudiante = null)
    {
        $this->claseEstudiante = $claseEstudiante;

        return $this;
    }

    /**
     * Get claseEstudiante
     *
     * @return \GEPedag\EntidadesBundle\Entity\ClaseEstudiante
     */
    public function getClaseEstudiante()
    {
        return $this->claseEstudiante;
    }

    /**
     * Set codigoBaja
     *
     * @param \GEPedag\EntidadesBundle\Entity\CodigoBaja $codigoBaja
     * @return Estudiante
     */
    public function setCodigoBaja(\GEPedag\EntidadesBundle\Entity\CodigoBaja $codigoBaja = null)
    {
        $this->codigoBaja = $codigoBaja;

        return $this;
    }

    /**
     * Get codigoBaja
     *
     * @return \GEPedag\EntidadesBundle\Entity\CodigoBaja
     */
    public function getCodigoBaja()
    {
        return $this->codigoBaja;
    }

    /**
     * Set procedenciaPapa
     *
     * @param \GEPedag\EntidadesBundle\Entity\ProcedenciaPadres $procedenciaPapa
     * @return Estudiante
     */
    public function setProcedenciaPapa(\GEPedag\EntidadesBundle\Entity\ProcedenciaPadres $procedenciaPapa = null)
    {
        $this->procedenciaPapa = $procedenciaPapa;

        return $this;
    }

    /**
     * Get procedenciaPapa
     *
     * @return \GEPedag\EntidadesBundle\Entity\ProcedenciaPadres
     */
    public function getProcedenciaPapa()
    {
        return $this->procedenciaPapa;
    }

    /**
     * Set tipoPlan
     *
     * @param \GEPedag\EntidadesBundle\Entity\TipoPlan $tipoPlan
     * @return Estudiante
     */
    public function setTipoPlan(\GEPedag\EntidadesBundle\Entity\TipoPlan $tipoPlan = null)
    {
        $this->tipoPlan = $tipoPlan;

        return $this;
    }

    /**
     * Get tipoPlan
     *
     * @return \GEPedag\EntidadesBundle\Entity\TipoPlan
     */
    public function getTipoPlan()
    {
        return $this->tipoPlan;
    }

    /**
     * Set especialidad
     *
     * @param \GEPedag\EntidadesBundle\Entity\Especialidad $especialidad
     * @return Estudiante
     */
    public function setEspecialidad(\GEPedag\EntidadesBundle\Entity\Especialidad $especialidad = null)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * @return \GEPedag\EntidadesBundle\Entity\Especialidad
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * @param \GEPedag\EntidadesBundle\Entity\Asignatura $asignatura
     * @return Estudiante
     */
    public function addAsignatura(\GEPedag\EntidadesBundle\Entity\Asignatura $asignatura)
    {
        $this->asignatura[] = $asignatura;

        return $this;
    }

    /**
     * @param \GEPedag\EntidadesBundle\Entity\Asignatura $asignatura
     */
    public function removeAsignatura(\GEPedag\EntidadesBundle\Entity\Asignatura $asignatura)
    {
        $this->asignatura->removeElement($asignatura);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAsignatura()
    {
        return $this->asignatura;
    }

    public function getBaja() {
        return $this->baja;
    }

    public function setBaja($baja) {
        $this->baja = $baja;
        return $this;
    }

    public function getAlta() {
        return $this->alta;
    }

    public function setAlta($alta) {
        $this->alta = $alta;
        return $this;
    }
}