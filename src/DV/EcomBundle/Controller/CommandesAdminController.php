<?php

namespace DV\EcomBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DV\EcomBundle\Entity\Commandes;
use DV\EcomBundle\Form\CommandesType;

/**
 * Commandes controller.
 *
 */
class CommandesAdminController extends Controller
{

    /**
     * Lists all Commandes entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EcomBundle:Commandes')->findAll();

        return $this->render('EcomBundle:Administration:Commandes/layout/index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function facturePDFAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //on récupère la  facture de $id en vérifiant que c'est bien le bon utilisateur et que valider=1 :  
        $facture = $em->getRepository('EcomBundle:Commandes')->find($id) ; 
        if(!$facture){
            $this->getFlashBag()->add('error', 'une erreur est survenue');
            return $this->redirect($this->generateUrl('adminCommandes'));
        }

        $this->container->get('setNewFacture')->facture($facture);
    }


    /**
     * Creates a new Commandes entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Commandes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adminCommandes_show', array('id' => $entity->getId())));
        }

        return $this->render('EcomBundle:Administration:Commandes/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Commandes entity.
     *
     * @param Commandes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Commandes $entity)
    {
        $form = $this->createForm(new CommandesType(), $entity, array(
            'action' => $this->generateUrl('adminCommandes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Commandes entity.
     *
     */
    public function newAction()
    {
        $entity = new Commandes();
        $form   = $this->createCreateForm($entity);

        return $this->render('EcomBundle:Administration:Commandes/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Commandes entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:Commandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commandes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EcomBundle:Administration:Commandes/layout/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Commandes entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:Commandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commandes entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EcomBundle:Administration:Commandes/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Commandes entity.
    *
    * @param Commandes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Commandes $entity)
    {
        $form = $this->createForm(new CommandesType(), $entity, array(
            'action' => $this->generateUrl('adminCommandes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Commandes entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:Commandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commandes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adminCommandes_edit', array('id' => $id)));
        }

        return $this->render('EcomBundle:Administration:Commandes/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Commandes entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EcomBundle:Commandes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Commandes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminCommandes'));
    }

    /**
     * Creates a form to delete a Commandes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminCommandes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
