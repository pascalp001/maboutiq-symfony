<?php

namespace AD\AdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AD\AdBundle\Entity\Fournisseurs;
use AD\AdBundle\Form\FournisseursType;

/**
 * Fournisseurs controller.
 *
 */
class FournisseursAdminController extends Controller
{

    /**
     * Lists all Fournisseurs entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdBundle:Fournisseurs')->findAll();

        return $this->render('AdBundle:Administration:Fournisseurs/layout/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Fournisseurs entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Fournisseurs();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adminFournisseurs_show', array('id' => $entity->getId())));
        }

        return $this->render('AdBundle:Administration:Fournisseurs/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Fournisseurs entity.
     *
     * @param Fournisseurs $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Fournisseurs $entity)
    {
        $form = $this->createForm(new FournisseursType(), $entity, array(
            'action' => $this->generateUrl('adminFournisseurs_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Enregistrer le nouveau fournisseur', 'attr'=>array('class'=>'btn btn-info', 'style'=>"min-width:200px;")));

        return $form;
    }

    /**
     * Displays a form to create a new Fournisseurs entity.
     *
     */
    public function newAction()
    {
        $entity = new Fournisseurs();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdBundle:Administration:Fournisseurs/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Fournisseurs entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdBundle:Fournisseurs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fournisseurs entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdBundle:Administration:Fournisseurs/layout/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Fournisseurs entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdBundle:Fournisseurs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fournisseurs entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdBundle:Administration:Fournisseurs/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Fournisseurs entity.
    *
    * @param Fournisseurs $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Fournisseurs $entity)
    {
        $form = $this->createForm(new FournisseursType(), $entity, array(
            'action' => $this->generateUrl('adminFournisseurs_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier', 'attr'=>array('class'=>'btn btn-info', 'style'=>"min-width:200px;")));

        return $form;
    }
    /**
     * Edits an existing Fournisseurs entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdBundle:Fournisseurs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fournisseurs entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adminFournisseurs_edit', array('id' => $id)));
        }

        return $this->render('AdBundle:Administration:Fournisseurs/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Fournisseurs entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdBundle:Fournisseurs')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fournisseurs entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminFournisseurs'));
    }

    /**
     * Creates a form to delete a Fournisseurs entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminFournisseurs_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Supprimer', 'attr'=>array('class'=>'btn btn-warning', 'style'=>"min-width:200px;")))           
            ->getForm()
        ;
    }
}
