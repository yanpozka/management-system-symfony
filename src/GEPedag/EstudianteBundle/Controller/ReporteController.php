<?php
namespace GEPedag\EstudianteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Slik\DompdfBundle\SlikDompdfBundle;

class ReporteController extends Controller {

    private function datosParteV() {
        $respo = $this->getDoctrine()->getManager()->getRepository('GEPedagEntidadesBundle:Estudiante');
        $todos = $respo->findTotalesXAnio();

        $totalesXTipoPlan = $respo->findTotalesXTipoPlan();

        return [
            'todos' => $todos,
            'totalesXTP' => $totalesXTipoPlan,
            'anio_sufijos' => [1 => 'ero.', 2 => 'do.', 3 => 'ro.', 4 => 'to.', 5 => 'to.'],
            'curso_escolar' => '2013 - 2014'
        ];
    }

    /**
     * @Method("GET")
     */
    public function parteVResultadosAction() {
        return $this->render("GEPedagEstudianteBundle:Reporte:partev.html.twig", $this->datosParteV('diurno'));
        $dompdf = $this->get('slik_dompdf');
        $strem = $this->get('templating')->render(
                "GEPedagEstudianteBundle:Reporte:partev.html.twig", $this->datosParteV('diurno'));
        // Generate the pdf
        $dompdf->getpdf($strem);
        // Either stream the pdf to the browser
        $dompdf->stream("Report.pdf");
        // Or get the output to handle it yourself
        $pdfoutput = $dompdf->output();
        return new Response($pdfoutput);
    }

}