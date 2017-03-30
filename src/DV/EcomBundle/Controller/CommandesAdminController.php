<?php

namespace DV\EcomBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

        $entities = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 0),array('date'=>'asc'));  
        $archive = "en cours";

        return $this->render('EcomBundle:Administration:Commandes/layout/index.html.twig', array(
            'entities' => $entities, 'archive' => $archive
        ));
    }
    
    public function nbCmdesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commandes = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 0));  
        $nbCmdesEnCours = count($commandes);
        $commandes = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 0, 'payer' => 1, 'preparer'=>0));  
        $nbNvellesCmdes = count($commandes);

        return $this->render('EcomBundle:Administration:Commandes/modulesUsed/nbCmdes.html.twig', array(
            'nbCmdesEnCours' => $nbCmdesEnCours, 'nbNvellesCmdes'=> $nbNvellesCmdes
        ));
    }


    public function archiveAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EcomBundle:Commandes')->findBy(array('archiver' => 1),array('date'=>'asc'));  
        $archive = " archivées";

        return $this->render('EcomBundle:Administration:Commandes/layout/index.html.twig', array(
            'entities' => $entities, 'archive' => $archive
        ));
    }

    public function modifAction($id, Request $request)
    {

        if($request->getMethod() == "POST") 
        {   
                $em = $this->getDoctrine()->getManager();
                $Commande = $em->getRepository('EcomBundle:Commandes')->find($id);
                //if (!$Commande) {
                 //   throw $this->createNotFoundException('Unable to find Commandes'.$id.' entity.');
                //}
                $avoir = array();
                $payeId    = $request->request->get('paye')   ; 
                $prepareId = $request->request->get('prepare');
                $livreId   = $request->request->get('livre')  ;
                $archiveId = $request->request->get('archive');
                $supprId   = $request->request->get('suppr')  ;

                if ($payeId[$id])      $Commande->setPayer ('1')   ;
                if ($prepareId[$id])  {
                    $Commande->setPreparer('1') ;
                    $avoir[$id] = $this->stockreel($Commande);
                }
                if ($livreId[$id])     $Commande->setLivrer ('1')  ;
                if ($archiveId[$id])   $Commande->setArchiver('1') ;           
                $em->persist($Commande);
                
                if ($supprId[$id]) $em->remove($Commande);

                $em->flush();  
    // Mail de statut :
            if($prepareId[$id] || $livreId[$id])
            {
                $message = \Swift_Message::newInstance()
                          ->setSubject('Votre commande en cours')
                          ->setFrom(array('pascal.p8610@gmail.com'=>"ProG-dev"))
                          ->setTo($Commande->getUtilisateur()->getEmailCanonical())
                          ->setCharset('utf-8')
                          ->setContentType('text/html');

                if($prepareId[$id])
                {
                    if($avoir[$id] && array_key_exists('produit', $avoir) ) 
                    { 
                        //Problème : stock insuffisant - avoir ou envoi plus tard ?
                        //Il va manquer $avoir[$id]['produit'][$id => $qte]
                        $message = $message->setBody($this->renderView('EcomBundle:Default:SwiftLayout/prepareCommande.html.twig', 
                        array('utilisateur'=> $Commande->getUtilisateur()))); 
                    }
                    else
                    {
                       $message = $message->setBody($this->renderView('EcomBundle:Default:SwiftLayout/prepareCommande.html.twig', 
                        array('utilisateur'=> $Commande->getUtilisateur())));  
                    }
                }
            

                if($livreId[$id]) { $message = $message->setBody($this->renderView('EcomBundle:Default:SwiftLayout/livreCommande.html.twig', 
                        array('utilisateur'=> $Commande->getUtilisateur()))); }

                $this->get('mailer')->send($message);            
            }

            $archive = "en cours";
            $entities = $em->getRepository('EcomBundle:Commandes')->findAll();
            return $this->render('EcomBundle:Administration:Commandes/layout/index.html.twig', array(
                'entities' => $entities, 'archive' => $archive
            ));
        }
        return $this->redirect($this->generateUrl('adminCommandes'));
    }

    private function stockreel($Commande)
    {
        $avoir=array();
        $em = $this->getDoctrine()->getManager();
        $commande = $Commande->getCommande();
        $produits = $commande['produit'];
        foreach($produits as $id => $produit)
        {
            $Produit = $em->getRepository('EcomBundle:Produits')->find($id);
            $qtePanier = $produit['quantite'];
            $stockreel = $Produit->getStockreel() - $qtePanier;
            if($stockreel<0)
            {
                $avoir = array('produit'=>array($id => -$stockreel));
                $stockreel = 0;
            }
            $Produit->setStockreel($stockreel);
            $em->persist($Produit);
        }
        $em->flush();
        return $avoir;
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

    public function bonlivraisonPDFAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //on récupère la  facture de $id en vérifiant que c'est bien le bon utilisateur et que valider=1 :  
        $facture = $em->getRepository('EcomBundle:Commandes')->find($id) ; 
        if(!$facture){
            $this->getFlashBag()->add('error', 'une erreur est survenue');
            return $this->redirect($this->generateUrl('adminCommandes'));
        }

        $this->container->get('setNewBL')->bonlivraison($facture);
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

        $form->add('submit', SubmitType::class, array('label' => 'Create'));

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
