<?php

namespace AD\AdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DV\EcomBundle\Entity\PromoCmdes;
use AD\AdBundle\Form\PromoCmdesType;

/**
 * PromoCmdes controller.
 *
 */
class PromoCmdesController extends Controller
{

    /**
     * Lists all PromoCmdes entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EcomBundle:PromoCmdes')->findAll();

        return $this->render('AdBundle:Administration:PromoCmdes/layout/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new PromoCmdes entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new PromoCmdes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adminPromoCmdes_show', array('id' => $entity->getId())));
        }

        return $this->render('AdBundle:Administration:PromoCmdes/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PromoCmdes entity.
     *
     * @param PromoCmdes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PromoCmdes $entity)
    {
        $form = $this->createForm(PromoCmdesType::class, $entity, array(
            'action' => $this->generateUrl('adminPromoCmdes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PromoCmdes entity.
     *
     */
    public function newAction()
    {
        $entity = new PromoCmdes();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdBundle:Administration:PromoCmdes/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PromoCmdes entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:PromoCmdes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PromoCmdes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdBundle:Administration:PromoCmdes/layout/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PromoCmdes entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:PromoCmdes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PromoCmdes entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdBundle:Administration:PromoCmdes/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PromoCmdes entity.
    *
    * @param PromoCmdes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PromoCmdes $entity)
    {
        $form = $this->createForm(PromoCmdesType::class, $entity, array(
            'action' => $this->generateUrl('adminPromoCmdes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PromoCmdes entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:PromoCmdes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PromoCmdes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adminPromoCmdes_edit', array('id' => $id)));
        }

        return $this->render('AdBundle:Administration:PromoCmdes/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PromoCmdes entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EcomBundle:PromoCmdes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PromoCmdes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminPromoCmdes'));
    }

    /**
     * Creates a form to delete a PromoCmdes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminPromoCmdes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
