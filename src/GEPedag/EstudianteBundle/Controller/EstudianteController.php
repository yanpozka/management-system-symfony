<?php

namespace GEPedag\EstudianteBundle\Controller;

//use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template; //al parecer tienen que estar en este orden
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use GEPedag\EntidadesBundle\Entity\Estudiante;
use GEPedag\EstudianteBundle\Form\EstudianteType;

class EstudianteController extends Controller {

    /**
     * @Method("GET")
     * @Template("GEPedagEstudianteBundle:Estudiante:index.html.twig")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        //$paginator = new Paginator($query, $fetchJoinCollection = true);
        return ['entities' =>
            $em->getRepository('GEPedagEntidadesBundle:Estudiante')->findTodosAsigns()];
    }

    /**
     * @Method("POST")
     * @Template("GEPedagEstudianteBundle:Estudiante:new_edit.html.twig")
     */
    public function createAction(Request $request) {
        $est_obj = new Estudiante();
        $form = $this->createForm(new EstudianteType(), $est_obj);
        $form->handleRequest($request);
        $msj = '';
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $ok_valido = TRUE;
            try {
                $em->persist($est_obj);
                $em->flush();
            } catch (\Doctrine\DBAL\DBALException $e) {
                $ok_valido = FALSE;
                $ex_msj = $e->getMessage();
                if (strpos($ex_msj, "Duplicate entry") && strpos($ex_msj, "PRIMARY")) {
                    $msj = "<br/>El número de carne de identidad ya está en uso.<br/>Por favor seleccione otro.";
                }
            }
            if ($ok_valido) {
                $this->get('session')->getFlashBag()->add(
                        'success', 'El estudiante  <i>' . $est_obj . '</i> se ha registrado con éxito!');
                return $this->redirect($this->generateUrl('ge_estudiante_show', ['id' => $est_obj->getCi()]));
            }
        } else {
            $msj = "<br/>Errores: " . count($form->getErrorsAsString()) . "<br/><ul>";
            foreach ($form->getErrors() as $elem) :
                $msj .= "<li>" . $elem->getMessage() . "</li>";
            endforeach;
            $msj .= "</ul>";
        }
        $this->get('session')->getFlashBag()->add(
                'error', 'Error al registrar.' . $msj);
        return $this->createArrayNewEditar($est_obj, 'create', $form);
    }

    private function createArrayNewEditar(Estudiante $est_obj, $action = 'create', $form = FALSE) {
        if ($form === FALSE)
            $form = $this->createForm(new EstudianteType(), $est_obj);
        $formulario = $form->createView();
        $selects_name = ['fuenteIngreso', 'procedenciaMadre', 'municipio',
            'provincia', 'procedenciaEscolar', 'claseEstudiante', 'codigoBaja',
            'procedenciaPapa', 'tipoPlan', 'especialidad', 'asignatura'];
        $selects_list = [];
        foreach ($formulario as $k => $elem) {
            if (in_array($k, $selects_name)) {
                //echo get_class($elem);
                //print_r($elem);die;
                $selects_list[] = $elem;
            }
        }

        $data = [
            'est_obj' => $est_obj,
            'form' => $formulario,
            'selects_list' => $selects_list
        ];
        if ($action == 'create')
            $action = $this->generateUrl('ge_estudiante_create');
        else {
            $action = $this->generateUrl(
                    'ge_estudiante_update', ['id' => $est_obj->getCi()]);
            $deleteForm = $this->createDeleteForm($est_obj->getCi());
            $data['delete_form'] = $deleteForm->createView();
        }
        $data['action'] = $action;
        return $data;
    }

    /**
     * @Method("GET")
     * @Template("GEPedagEstudianteBundle:Estudiante:new_edit.html.twig")
     */
    public function newAction() {
        $est_obj = new Estudiante();
        $today = new \DateTime('today');
        $est_obj->setFechaIngrIsp($today);
        $est_obj->setFechaIngrEducSup($today);
        $est_obj->setFechaIngrEsp($today);

        return $this->createArrayNewEditar($est_obj);
    }

    /**
     * @Method("GET")
     * @Template("GEPedagEstudianteBundle:Estudiante:show.html.twig")
     */
    public function detallesAction($id) {
        $em = $this->getDoctrine()->getManager();
        $est_obj = $em->getRepository('GEPedagEntidadesBundle:Estudiante')->find($id);
        if (!$est_obj) {
            throw $this->createNotFoundException('Imposible encontrar al Estudiante con carne de id: ' . $id);
        }
        $deleteForm = $this->createDeleteForm($id);
        return array(
            'entity' => $est_obj,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * @Method("GET")
     * @Template("GEPedagEstudianteBundle:Estudiante:new_edit.html.twig")
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $est_obj = $em->getRepository('GEPedagEntidadesBundle:Estudiante')->find($id);
        if (!$est_obj) {
            throw $this->createNotFoundException(
                    'Imposible encontrar al Estudiante con carne de id: ' . $id);
        }
        return $this->createArrayNewEditar($est_obj, 'edit');
    }

    /**
     * @Method("POST")
     * @Template("GEPedagEstudianteBundle:Estudiante:new_edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $est_obj = $em->getRepository('GEPedagEntidadesBundle:Estudiante')->find($id);
        if (!$est_obj) {
            throw $this->createNotFoundException('Imposible encontrar al Estudiante con carne de id: ' . $id);
        }

        $editForm = $this->createForm(new EstudianteType(), $est_obj);
        $editForm->handleRequest($request);
        $msj = '';
        if ($editForm->isValid()) {
            $ok_valido = TRUE;
            try {
                //$em->persist($est_obj);
                $em->flush();
            } catch (\Doctrine\DBAL\DBALException $e) {
                $ok_valido = FALSE;
                $msj = $e->getMessage();
            }
            if ($ok_valido) {
                $this->get('session')->getFlashBag()->add(
                        'success', 'Los datos de <i>' . $est_obj . '</i> se ha actualizado correctamente!');
                return $this->redirect($this->generateUrl('ge_estudiante_edit', ['id' => $est_obj->getCi()]));
            }
        }
        $this->get('session')->getFlashBag()->add(
                'error', 'Error al actualizar verifique sus datos.<br/>' . $msj);
        return $this->redirect($this->generateUrl('ge_estudiante_edit', ['id' => $est_obj->getCi()]));
    }

    /**
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GEPedagEntidadesBundle:Estudiante')->find($id);
            if (!$entity) {
                throw $this->createNotFoundException(
                        'Imposible encontrar al Estudiante con carne de id: ' . $id);
            }
            $em->remove($entity);
            $em->flush();
        }
        $this->get('session')->getFlashBag()->add(
                'success', 'Eliminado correctamente estudiante con carne de id: ' . $id);
        return $this->redirect($this->generateUrl('ge_estudiante_homepage'));
    }

    /**
     * Creates a form to delete a Estudiante entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('ge_estudiante_delete', array('id' => $id)))
                        ->setMethod('POST')
                        ->add('submit', 'submit', array('label' => 'Eliminar'))
                        ->getForm();
    }

}
