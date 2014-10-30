<?php
namespace GEPedag\EntidadesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GEPedag\EntidadesBundle\Entity\Especialidad;
use GEPedag\EntidadesBundle\Form\EspecialidadType;

class EspecialidadController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('GEPedagEntidadesBundle:Especialidad')->findAll();

        return $this->render('GEPedagEntidadesBundle:Especialidad:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Especialidad entity.
     */
    public function createAction(Request $request)
    {
        $especialidad = new Especialidad();
        $form = $this->createForm(new EspecialidadType(), $especialidad);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($especialidad);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success', 'Muy Bien! La especialidad <i>' . $especialidad . '</i> se ha registrado con éxito!');
            return $this->redirect($this->generateUrl('especialidad'));
        }
        $this->get('session')->getFlashBag()->add(
            'error', 'Error al registrar la Especialidad. Debe corregir los errores que se listan.');
        return $this->redirect($this->generateUrl('especialidad'));
    }

    /**
     * Displays a form to create a new Especialidad entity.
     */
    public function newAction()
    {
        $entity = new Especialidad();
        $form = $this->createForm(new EspecialidadType(), $entity);

        return $this->render('GEPedagEntidadesBundle:Especialidad:new_edit.html.twig', array(
            'titulo' => 'crear',
            'action' => $this->generateUrl('especialidad_create'),
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Especialidad entity.
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GEPedagEntidadesBundle:Especialidad')->find($id);
        if (!$entity) {
            $this->get('session')->getFlashBag()->add(
                'error', 'No existe la especialidad.');
            return $this->redirect($this->generateUrl('especialidad'));
        }

        $editForm = $this->createForm(new EspecialidadType(), $entity);

        return $this->render('GEPedagEntidadesBundle:Especialidad:new_edit.html.twig', array(
            'titulo' => 'editar',
            'entity' => $entity,
            'action' => $this->generateUrl('especialidad_update', array('id' => $entity->getId())),
            'form' => $editForm->createView()
        ));
    }

    /**
     * Edits an existing Especialidad entity.
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $especialidad = $em->getRepository('GEPedagEntidadesBundle:Especialidad')->find($id);
        if (!$especialidad) {
            $this->get('session')->getFlashBag()->add(
                'error', 'No existe la especialidad.');
            return $this->redirect($this->generateUrl('especialidad'));
        }
        $editForm = $this->createForm(new EspecialidadType(), $especialidad);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($especialidad);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success', 'Muy Bien! La especialidad <i>' . $especialidad . '</i> se ha actualizado con éxito!');
            return $this->redirect($this->generateUrl('especialidad'));
        }
        $this->get('session')->getFlashBag()->add(
            'error', 'Error al actualizar la especialidad.');
        return $this->redirect($this->generateUrl('especialidad'));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $especialidad = $em->getRepository('GEPedagEntidadesBundle:Especialidad')->find($id);
        if (!$especialidad) {
            $this->get('session')->getFlashBag()->add(
                'error', 'No existe la especialidad.');
            return $this->redirect($this->generateUrl('especialidad'));
        }
        $em->remove($especialidad); //!!
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success', 'La especialidad <i>' . $especialidad . '</i> se ha eliminado con éxito!');
        return $this->redirect($this->generateUrl('especialidad'));
    }
}
