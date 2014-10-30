<?php

namespace GEPedag\EntidadesBundle\Entity;

use Doctrine\ORM\EntityRepository;

//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\ORM\Query\Parameter;

class EstudianteRepository extends EntityRepository {

    public function findTodosAsigns() {
        //"SELECT e, m, esp FROM GEPedagEntidadesBundle:Estudiante e JOIN e.municipio m JOIN e.especialidad esp";
        $query = $this->createQueryBuilder('et')
                ->select('et', 'm', 'esp')
                ->join('et.municipio', 'm')
                ->join('et.especialidad', 'esp')
                ->getQuery();
        return $query->getResult();
    }

    public function findTotalesXAnio() {
//        $query = $this->createQueryBuilder('et')
//                ->join('et.tipoCurso', 'tc')
//                ->where('et.tipoCurso = :tipo_curso')
//                ->setParameters(new ArrayCollection([
//                    new Parameter('tipo_curso', $tipo_curso)
//                ]))
//                ->groupBy('et.anioEstudio')
//                ->getQuery();
//        $MI = count($query->getResult());
        $MI = count($this->findAll());
        $altas = count($this->findBy(['alta' => 1]));
        $bajas = count($this->findBy(['baja' => 1]));

        return [
            'MI' => $MI,
            'ALTAS' => $altas,
            'BAJAS' => $bajas,
            'MF' => $MI - $bajas + $altas,
        ];
    }

    private function totalAprovadosLimpios() {
        
    }

    public function findTotalesXTipoPlan() {
        return [];
    }

}