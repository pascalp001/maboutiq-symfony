<?php

namespace DV\EcomBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use DV\EcomBundle\Entity\Produits;
use DV\EcomBundle\Entity\Tva;
use DV\EcomBundle\Entity\Reassort;
use DV\EcomBundle\Entity\PrdReassort;
use DV\EcomBundle\Form\ProduitsType;
use DV\EcomBundle\Form\ReassortType;

/**
 * Produits controller.
 *
 */
class ProduitsAdminController extends Controller
{

    /**
     * Lists all Produits entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EcomBundle:Produits')->findAll();

        return $this->render('EcomBundle:Administration:Produits/layout/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Produits entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Produits();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setStockvirtuel($entity->getStockreel());
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adminProduits_show', array('id' => $entity->getId())));
        }

        return $this->render('EcomBundle:Administration:Produits/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Produits entity.
     *
     * @param Produits $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Produits $entity)
    {
        /*$form = $this->createForm(new ProduitsType(), $entity, array(
            'action' => $this->generateUrl('adminProduits_create'),
            'method' => 'POST',
        ));*/
        $form = $this->createForm(new ProduitsType(), $entity );

        $form->add('submit', SubmitType::class, array('label' => 'Créer le nouveau produit', 'attr'=>array('class'=>'btn btn-info')));

        return $form;
    }

    /**
     * Displays a form to create a new Produits entity.
     *
     */
    public function newAction()
    {
        $entity = new Produits();
        $tva = new Tva();
        $em = $this->getDoctrine()->getManager();
        $tva = $em->getRepository('EcomBundle:Tva')->findOneByNom('TVA 20%');
        
        $entity->setTva($tva);
        $form   = $this->createCreateForm($entity);

        return $this->render('EcomBundle:Administration:Produits/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Produits entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:Produits')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Produits entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EcomBundle:Administration:Produits/layout/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Produits entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:Produits')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Produits entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EcomBundle:Administration:Produits/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Produits entity.
    *
    * @param Produits $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Produits $entity)
    {
        /*$form = $this->createForm(new ProduitsType(), $entity, array(
            'action' => $this->generateUrl('adminProduits_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));*/

        $form = $this->createForm(new ProduitsType(), $entity);

        $form->add('submit', SubmitType::class, array('label' => 'Modifier ce produit', 'attr'=>array('class'=>'btn btn-info')));

        return $form;
    }
    /**
     * Edits an existing Produits entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EcomBundle:Produits')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Produits entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adminProduits_edit', array('id' => $id)));
        }

        return $this->render('EcomBundle:Administration:Produits/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Produits entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EcomBundle:Produits')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Produits entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminProduits'));
    }

    /**
     * Creates a form to delete a Produits entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminProduits_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Supprimer', 'attr'=>array('class'=>'btn btn-greyish')))
            ->getForm()
        ;
    }

    public function reassortAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // Extraction des commandes préparées et non préparées 
        // Crée les objets $CommandesV et $CommandesP :
        $CommandesV = $em->getRepository('EcomBundle:Commandes')->findByPreparer('1');
        $CommandesP = $em->getRepository('EcomBundle:Commandes')->findByPreparer('0');
        $mois0 = (int)date('m');
        $Reassort = new Reassort();
       
        // Extraction des produits :
        $Produits = $em->getRepository('EcomBundle:Produits')->findAll();

        $cadencierV = array(); //Tableau des commandes simplement validées
        $cadencierP = array(); //Tableau des commandes préparées (et livrées ou non)
        $cmdesV = array();

        // Création du buildform global :
        //$buildform = $this->createFormBuilder();
        //$buildform->add(new ReassortType);
        //$form = $buildform->getForm();


        // Initialisation des tableau $cadencierV[produit][mois] et $cadencierP[produit][mois]:
        foreach($Produits as $Produit)
        {   
            $id=$Produit->getId();
            $cmdesV[$id] = 0;
            for($i=1; $i<13; $i++ )
            {
                $cadencierV[$id][$i] = 0;
                $cadencierP[$id][$i] = 0;
                $cmdesV[$id] = 0;
            }
        }

        // Création du tableau du cadencier pour les commandes simplement validées :
        foreach ($CommandesV as $CommandeV) 
        {   
            // Extraction du mois de la commande :
            $date = $CommandeV->getDate();  
            $mois = (int)$date->format('m');

            // Extraction des produits et quantités de la commande, cumul des quantités :            
            $commande = $CommandeV->getCommande();
            $produits = $commande['produit'];
            foreach($produits as $id => $produit)
            {
                $qtePanier = $produit['quantite'];
                $cadencierV[$id][$mois] += $qtePanier;
                //Cumul des produits validés non préparés pour le calcul des stocks virtuels théoriques : 
                $cmdesV[$id] += $qtePanier; 
            }
        }
        // Création du tableau du cadencier pour les commandes préparées :
        foreach ($CommandesP as $CommandeP) 
        {   
            $date = $CommandeP->getDate();  
            $mois = (int)$date->format('m');
            
            $commande = $CommandeP->getCommande();
            $produits = $commande['produit'];
            foreach($produits as $id => $produit)
            {
                $qtePanier = $produit['quantite'];
                $cadencierP[$id][$mois] += $qtePanier; 
            }
        }
        //Création du tableau des 12 derniers mois :
        for($i=1; $i<13; $i++ )
        {
            $cad[$i] = ($mois0+$i-1)%12+1;
        }        
        // On dispose donc pour chaque produit.id 
        // - d'un tableau $cadencierP[$id] sur 12 mois
        // - d'un tableau $cadencierV[$id] sur 12 mois
        // - d'un tableau $cmdesV[$id] sur 12 mois

         $Produits = $em->getRepository('EcomBundle:Produits')->findAll();
        foreach($Produits as $produit)
        {          
            $id = $produit->getId();
            $PrdReassort = new PrdReassort();
            $PrdReassort->setId($id);
            $PrdReassort->setNom($produit->getNom()); 
            $PrdReassort->setPopularite($produit->getPopularite());
            $PrdReassort->setDisponible($produit->getDisponible()); 
            $PrdReassort->setStockreel($produit->getStockreel());
            $PrdReassort->setStockvirtuel($produit->getStockvirtuel());
            $PrdReassort->setCmdeV($cmdesV[$id]);
            $PrdReassort->setCmdeV1($cadencierV[$id][$cad[1]]);
            $PrdReassort->setCmdeV2($cadencierV[$id][$cad[2]]);
            $PrdReassort->setCmdeV3($cadencierV[$id][$cad[3]]);
            $PrdReassort->setCmdeV4($cadencierV[$id][$cad[4]]);
            $PrdReassort->setCmdeV5($cadencierV[$id][$cad[5]]);
            $PrdReassort->setCmdeV6($cadencierV[$id][$cad[6]]);
            $PrdReassort->setCmdeV7($cadencierV[$id][$cad[7]]);
            $PrdReassort->setCmdeV8($cadencierV[$id][$cad[8]]);
            $PrdReassort->setCmdeV9($cadencierV[$id][$cad[9]]);
            $PrdReassort->setCmdeV10($cadencierV[$id][$cad[10]]);
            $PrdReassort->setCmdeV11($cadencierV[$id][$cad[11]]);
            $PrdReassort->setCmdeV12($cadencierV[$id][$cad[12]]);
            $PrdReassort->setCmdeP1($cadencierP[$id][$cad[1]]);
            $PrdReassort->setCmdeP2($cadencierP[$id][$cad[2]]);
            $PrdReassort->setCmdeP3($cadencierP[$id][$cad[3]]);
            $PrdReassort->setCmdeP4($cadencierP[$id][$cad[4]]);
            $PrdReassort->setCmdeP5($cadencierP[$id][$cad[5]]);
            $PrdReassort->setCmdeP6($cadencierP[$id][$cad[6]]);
            $PrdReassort->setCmdeP7($cadencierP[$id][$cad[7]]);
            $PrdReassort->setCmdeP8($cadencierP[$id][$cad[8]]);
            $PrdReassort->setCmdeP9($cadencierP[$id][$cad[9]]);
            $PrdReassort->setCmdeP10($cadencierP[$id][$cad[10]]);
            $PrdReassort->setCmdeP11($cadencierP[$id][$cad[11]]);
            $PrdReassort->setCmdeP12($cadencierP[$id][$cad[12]]);
            $Reassort->addPrdReassort($PrdReassort);
        }

        $form = $this->createForm(ReassortType::class, $Reassort);

       $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $PrdReassorts = $Reassort->getPrdReassort();
            foreach($PrdReassorts as $prdReassort)
            {          
                $id = $prdReassort->getId();            
                $Produit = $em->getRepository('EcomBundle:Produits')->find($id);
                $Produit->setStockreel($Produit->getStockreel()+$prdReassort->getReassort());
                $Produit->setStockvirtuel($Produit->getStockvirtuel()+$prdReassort->getReassort()+$prdReassort->getAjust());
                $em->persist($Produit);
            }
            $em->flush();
             return $this->redirect($this->generateUrl('adminProduits_reassort'));
        }

        //var_dump($cadencier);
//die();
        return $this->render('EcomBundle:Administration:Produits/layout/reassort.html.twig', array(
            'Produits' => $Produits, 'cad' => $cad, 'cadencierP' => $cadencierP,'cadencierV' => $cadencierV, 'cmdesV'=> $cmdesV, 'form'=>$form->createView()
        ));
    }
}
