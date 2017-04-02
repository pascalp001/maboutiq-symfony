<?php

namespace AD\AdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DV\EcomBundle\Entity\Tarif;
use AD\AdBundle\Form\TarifType;

/**
 * Tarif controller.
 *
 */
class TarifAdminController extends Controller
{

    /**
     * Lists all Tarif entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EcomBundle:Tarif')->findAll();
        return $this->render('AdBundle:Administration:Tarif/layout/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tarif entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Tarif();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adminTarif'));
        }

        return $this->render('AdBundle:Administration:Tarif/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tarif entity.
     *
     * @param Tarif $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tarif $entity)
    {
        $form = $this->createForm(new TarifType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Enregistrer ce nouveau tarif', 'attr'=>array('class'=>'btn btn-info')));
        
        return $form;
    }

    /**
     * Displays a form to create a new Tarif entity.
     *
     */
    public function newAction()
    {
        $entity = new Tarif();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdBundle:Administration:Tarif/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing Tarif entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:Tarif')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tarif entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdBundle:Administration:Tarif/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tarif entity.
    *
    * @param Tarif $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tarif $entity)
    {
        $form = $this->createForm(new TarifType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Modifier', 'attr'=>array('class'=>'btn btn-info')));

        return $form;
    }
    /**
     * Edits an existing Tarif entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:Tarif')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tarif entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adminTarif'));
        }

        return $this->render('AdBundle:Administration:Tarif/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tarif entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EcomBundle:Tarif')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tarif entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminTarif'));
    }

    /**
     * Creates a form to delete a Tarif entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminTarif_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', 'attr'=>array('class'=>'btn btn-warning')))
            ->getForm()
        ;
    }
}
