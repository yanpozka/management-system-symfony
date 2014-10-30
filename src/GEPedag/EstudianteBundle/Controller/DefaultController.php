<?php

namespace GEPedag\EstudianteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller {

    /**
     * @Template("GEPedagEstudianteBundle:Default:login.html.twig")
     */
    public function loginAction(Request $request) {
        
        //$customerEm = $this->get('doctrine')->getManager('access');
        $manager = $this->getDoctrine()->getManager('access');
        
//        try {
//            $message = \Swift_Message::newInstance()
//                ->setSubject('Administrador de SecreGest')
//                ->setFrom('administrador@secre-gest.com')
//                ->setTo('ivis@ucp.cf.rimed.cu')
//                ->addCc('ypozo@ucp.cf.rimed.cu')
//                ->setBody(
//                $this->renderView('GEPedagEstudianteBundle:Default:mail.txt.twig'));
//            $this->get('mailer')->send($message);
//        }
//        catch (\Exception $e) {
//        }
//        try {
//            $conn = new \PDO('odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=D:\\yandry\\CDNICIO201314.MDB;');
//        } catch (Exception $exc) {
//            echo $exc->getMessage() . "<br><br>";die;
//        }
//        $sql = "select * from BoletaISPEstudiante;";
//        foreach ($conn->query($sql) as $row) {
//            foreach ($row as $key => $val)
//                echo $key . ": " . $val . "<br>";
//            echo "<br>";die;
//        }
        $peticion = $request;
        $sesion = $peticion->getSession();
        $error = $peticion->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR, $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );

        return [
            'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
            'error' => $error];
    }

//    public function logoutAction() {
//        return $this->redirect($this->generateUrl('ge_estudiante_login'));
//    }

    public function indexredirectAction() {
        return $this->redirect($this->generateUrl('ge_estudiante_homepage'));
    }

}