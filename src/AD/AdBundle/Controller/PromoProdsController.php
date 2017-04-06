<?php

namespace AD\AdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DV\EcomBundle\Entity\PromoProds;
use AD\AdBundle\Form\PromoProdsType;

/**
 * PromoProds controller.
 *
 */
class PromoProdsController extends Controller
{

    /**
     * Lists all PromoProds entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $now = new \DateTime();
        $entities = $em->getRepository('EcomBundle:PromoProds')->findByDateFin($now);

        return $this->render('AdBundle:Administration:PromoProds/layout/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new PromoProds entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new PromoProds();
        $entity->setDatedeb(new \Datetime())
                ->setArticlePub('1');
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adminPromoProds_show', array('id' => $entity->getId())));
        }

        return $this->render('AdBundle:Administration:PromoProds/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PromoProds entity.
     *
     * @param PromoProds $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PromoProds $entity)
    {
        $form = $this->createForm(new PromoProdsType(), $entity, array(
            'action' => $this->generateUrl('adminPromoProds_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Enregistrer cette promo', 'attr'=>array('class'=>'btn btn-info')));

        return $form;
    }

    /**
     * Displays a form to create a new PromoProds entity.
     *
     */
    public function newAction()
    {
        $entity = new PromoProds();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdBundle:Administration:PromoProds/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PromoProds entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:PromoProds')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PromoProds entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdBundle:Administration:PromoProds/layout/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PromoProds entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:PromoProds')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PromoProds entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdBundle:Administration:PromoProds/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PromoProds entity.
    *
    * @param PromoProds $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PromoProds $entity)
    {
        $form = $this->createForm(new PromoProdsType(), $entity, array(
            'action' => $this->generateUrl('adminPromoProds_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier la promotion', 'attr'=>array('class'=>'btn btn-info')));

        return $form;
    }
    /**
     * Edits an existing PromoProds entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:PromoProds')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PromoProds entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adminPromoProds_edit', array('id' => $id)));
        }

        return $this->render('AdBundle:Administration:PromoProds/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PromoProds entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EcomBundle:PromoProds')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PromoProds entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminPromoProds'));
    }

    /**
     * Creates a form to delete a PromoProds entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminPromoProds_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', 'attr'=>array('class'=>'btn btn-warning')))
            ->getForm()
        ;
    }
}
