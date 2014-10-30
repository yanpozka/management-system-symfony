<?php

namespace GEPedag\EntidadesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use GEPedag\EntidadesBundle\Entity\Asignatura;
use GEPedag\EntidadesBundle\Form\AsignaturaType;

class AsignaturaController extends Controller {

    /**
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('GEPedagEntidadesBundle:Asignatura')->findAll();
        return [
            'entities' => $entities
        ];
    }

    /**
     * @Method("POST")
     */
    public function createAction(Request $request) {
        $asignatura = new Asignatura();
        $form = $this->createForm(new AsignaturaType(), $asignatura);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asignatura);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'La asignatura  <i>' . $asignatura . '</i> se ha creado con éxito!');
            return $this->redirect($this->generateUrl('ge_asign_homepage'));
        }
//        print_r($form->getErrors());die;
//        foreach ($form->getErrors() as $error) {
//        }
        $this->get('session')->getFlashBag()->add('error', 'Error al registrar la asignatura.');
        return $this->redirect($this->generateUrl('ge_asign_homepage'));
    }

    /**
     * @Method("GET")
     * @Template("GEPedagEntidadesBundle:Asignatura:new_edit.html.twig")
     */
    public function newAction() {
        $asignatura = new Asignatura();
        $titulo = 'Crear';
        $form = $this->createForm(new AsignaturaType(), $asignatura);
        $form->add('submit', 'submit', array('label' => $titulo));
        return [
            'action' => $this->generateUrl('ge_asign_create'),
            'entity' => $asignatura,
            'form' => $form->createView(),
            'titulo' => $titulo,
        ];
    }

    /**
     * @Method("GET")
     */
    public function editAction($id) {
        $titulo = 'Actualizar';
        $em = $this->getDoctrine()->getManager();
        $asignatura = $em->getRepository('GEPedagEntidadesBundle:Asignatura')->find($id);
        if (!$asignatura) {
            throw $this->createNotFoundException('No existe la Asignatura con id: ' . $id);
        }
        $editForm = $this->createForm(new AsignaturaType(), $asignatura);
        $editForm->add('submit', 'submit', array('label' => $titulo));

        return $this->render('GEPedagEntidadesBundle:Asignatura:new_edit.html.twig', [
                    'action' => $this->generateUrl('ge_asign_update', array('id' => $asignatura->getId())),
                    'entity' => $asignatura,
                    'titulo' => $titulo,
                    'form' => $editForm->createView()
        ]);
    }

    /**
     * @Method("POST")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $asignatura = $em->getRepository('GEPedagEntidadesBundle:Asignatura')->find($id);
        if (!$asignatura) {
            $this->get('session')->getFlashBag()->add(
                    'error', 'No existe la asignatura con id: ' . $id);
            return $this->redirect($this->generateUrl('ge_asign_homepage'));
        }

        $editForm = $this->createForm(new AsignaturaType(), $asignatura);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($asignatura);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'Muy Bien! La asignatura <i>' . $asignatura . '</i> se ha actualizado con éxito!');
            return $this->redirect($this->generateUrl('ge_asign_homepage'));
        }

        $this->get('session')->getFlashBag()->add(
                'success', 'Error al crear la asignatura.');
        return $this->redirect($this->generateUrl('ge_asign_homepage'));
    }

    /**
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $asignatura = $em->getRepository('GEPedagEntidadesBundle:Asignatura')->find($id);
        if (!$asignatura) {
            $this->get('session')->getFlashBag()->add(
                    'error', 'No existe la asignatura con id: ' . $id);
            return $this->redirect($this->generateUrl('ge_asign_homepage'));
        }
        $em->remove($asignatura);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
                'success', 'La asignatura <i>' . $asignatura . '</i> se ha eliminado.');
        return $this->redirect($this->generateUrl('ge_asign_homepage'));
    }

}
