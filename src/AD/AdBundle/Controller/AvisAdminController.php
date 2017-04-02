<?php

namespace AD\AdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use DV\EcomBundle\Entity\Avis;
use AD\AdBundle\Form\AvisCompletType;

/**
 * Avis controller.
 *
 */
class AvisAdminController extends Controller
{

    /**
     * Lists all avis non validés.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $aviss = $em->getRepository('EcomBundle:Avis')->findByValid('0');

        return $this->render('AdBundle:Administration:Avis/layout/index.html.twig', array(
            'aviss' => $aviss,
        ));
    }

    /**
     * Trouve et affiche tous les avis validés.
     *
     */
    public function avisvalidAction()
    {
        $em = $this->getDoctrine()->getManager();
        $aviss = $em->getRepository('EcomBundle:Avis')->findByValid('1');

        return $this->render('AdBundle:Administration:Avis/layout/avisvalid.html.twig', array(
            'aviss' => $aviss
        ));
    }

   public function nbAvisAction()
    {
        $em = $this->getDoctrine()->getManager();
        $avis = $em->getRepository('EcomBundle:Avis')->findByValid('0');  
        $nbAvis = count($avis);
        return $this->render('AdBundle:Administration:Avis/modulesUsed/nbAvis.html.twig', array(
            'nbAvis' => $nbAvis
        ));
    }

    public function modifAction($id, Request $request)
    {
        if($request->getMethod() == "POST") 
        {   
            $em = $this->getDoctrine()->getManager();
            $avis = $em->getRepository('EcomBundle:Avis')->find($id);

            $validId    = $request->request->get('valid')   ; 
            $supprId   = $request->request->get('suppr')  ;

            if ($validId[$id])      $avis->setValid ('1')   ;          
            $em->persist($avis);
            
            if ($supprId[$id]) $em->remove($avis);

            $em->flush(); 
        $aviss = $em->getRepository('EcomBundle:Avis')->findByValid('0');
        return $this->render('AdBundle:Administration:Avis/layout/index.html.twig', array(
            'aviss' => $aviss
        ));
        }
        return $this->redirect($this->generateUrl('adminAvis'));
    }

    /**
     * Trouve et affiche les avis d'un produit.
     *
     */
    public function avisproduitAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('EcomBundle:Produits')->find($id);
        $aviss = $em->getRepository('EcomBundle:Avis')->findBy(array('produit'=>$produit, 'valid'=>'1'));

        return $this->render('AdBundle:Administration:Avis/layout/avisproduit.html.twig', array(
            'aviss' => $aviss, 'produit' => $produit
        ));
    }


    /**
     * Finds and displays a avis.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $avis = $em->getRepository('EcomBundle:Avis')->find($id);

        if (!$avis) {
            throw $this->createNotFoundException('Avis pas trouvé.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdBundle:Administration:Avis/layout/show.html.twig', array(
            'avis'      => $avis,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing avis.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $avis = $em->getRepository('EcomBundle:Avis')->find($id);

        if (!$avis) {
            throw $this->createNotFoundException('Pas trouvé Avis avis.');
        }

        $editForm = $this->createEditForm($avis);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdBundle:Administration:Avis/layout/edit.html.twig', array(
            'avis'      => $avis,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Avis entity.
    *
    * @param Avis $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Avis $avis)
    {
        $form = $this->createForm(new AvisCompletType(), $avis, array(
            'action' => $this->generateUrl('adminAvis_update', array('id' => $avis->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Modifier', 'attr'=>array('class'=>'btn btn-info')));

        return $form;
    }

    /**
     * Edits an existing Avis entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $avis = $em->getRepository('EcomBundle:Avis')->find($id);

        if (!$avis) {
            throw $this->createNotFoundException('Unable to find Avis entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($avis);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adminAvis_edit', array('id' => $id)));
        }

        return $this->render('AdBundle:Administration:Avis/layout/edit.html.twig', array(
            'avis'      => $avis,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Avis entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $avis = $em->getRepository('EcomBundle:Avis')->find($id);

            if (!$avis) {
                throw $this->createNotFoundException('Unable to find Avis entity.');
            }

            $em->remove($avis);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminAvis'));
    }

    /**
     * Creates a form to delete a Avis entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminAvis_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit',SubmitType::class, array('label' => 'Supprimer', 'attr'=>array('class'=>'btn btn-warning')))
            ->getForm()
        ;
    }
}
