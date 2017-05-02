<?php

namespace AD\AdBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use DV\EcomBundle\Entity\Produits;
use AD\AdBundle\Entity\Reassort;
use AD\AdBundle\Entity\PrdReassort;
use AD\AdBundle\Form\ReassortType;
use AD\AdBundle\Entity\Demarque;
use AD\AdBundle\Entity\PrdDemarque;
use AD\AdBundle\Form\DemarqueType;
use AD\AdBundle\Entity\Inventr;
use AD\AdBundle\Entity\PrdInventr;
use AD\AdBundle\Form\InventrType;

/**
 * Stocks controller.
 *
 */
class StocksAdminController extends Controller
{
    private function cadencierMaker($v, $Produits)
    {
        $em = $this->getDoctrine()->getManager();
        // Extraction des commandes préparées et non préparées 
        // Crée les objets $CommandesV et $CommandesP :
        $Commandes = $em->getRepository('EcomBundle:Commandes')->findByPreparer($v);

        $cadencier = array(); //Tableau des commandes 

        // Initialisation du tableau $cadencier[produit][mois] :
        foreach($Produits as $Produit)
        {   
            $id=$Produit->getId();
            $cmdes[$id] = 0;
            for($i=1; $i<13; $i++ )
            {
                $cadencier[$id][$i] = 0;
            }
        }

        // Création du tableau du cadencier pour les commandes passées:
        foreach ($Commandes as $Commande) 
        {   
            // Extraction du mois de la commande :
            $date = $Commande->getDate();  
            $mois = (int)$date->format('m');

            // Extraction des produits et quantités de la commande, cumul des quantités :            
            $commande = $Commande->getCommande();
            $produits = $commande['produit'];
            foreach($produits as $id => $produit)
            {
                $qtePanier = $produit['quantite'];
                $cadencier[$id][$mois] += $qtePanier;
            }
        }

        return $cadencier;
    }

    private function moyVtes($mois0, $cadencierV, $cadencierP, $id)
    {
        // Détermination du flux moyen par produit :

            $moy=0;$nm=0;
            for($m = $mois0+1 ; $m<13 ; $m++)
            {
                if($moy==0){
                    $moy=$cadencierP[$id][$m] +$cadencierV[$id][$m]; 
                    if($moy!=0){$nm=1;}
                }
                else{
                    $moy=$moy+$cadencierP[$id][$m] +$cadencierV[$id][$m];
                    $nm++;
                }                
            }
            for($m = 1 ; $m<$mois0 ; $m++)
            {
                if($moy==0){
                    $moy=$cadencierP[$id][$m] +$cadencierV[$id][$m]; 
                    if($moy!=0){$nm=1;}
                }
                else{
                    $moy=$moy+$cadencierP[$id][$m] +$cadencierV[$id][$m];
                    $nm++;
                } 
            }
            $m=$mois0; $jours=max(12,(int)date('j')); $nbjours = cal_days_in_month(CAL_GREGORIAN, $mois0, (int)date('Y'));
                $moy=$moy + ( $nbjours / $jours)*($cadencierP[$id][$m] + $cadencierV[$id][$m]) ;
                $nm++;
            //Calcul final :
                $moy=round( $moy / $nm );
          
        return $moy;
    }

    public function reassortAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $mois0 = (int)date('m'); // = mois en cours
        $tabMois = array('janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre');
        $moistxt = $tabMois[$mois0-1];

        $moy=array(); $nm=array();$cmdesV = array();

        // Extraction des produits :
        $Produits = $em->getRepository('EcomBundle:Produits')->findAll();

        $Reassort = new Reassort(); 

        $cadencierV = $this->cadencierMaker('0', $Produits);
        $cadencierP = $this->cadencierMaker('1', $Produits);
        foreach($Produits as $Produit)
        {   
            $id=$Produit->getId();
            $cmdesV[$id] = 0;
            $moyVtes[$id] = 0;
            for($i=1; $i<13; $i++ )
            {
                $cmdesV[$id] += $cadencierV[$id][$i];
            }
            $moyVtes[$id] =  $this->moyVtes($mois0, $cadencierV, $cadencierP, $id);
        }

        //Création du tableau des 12 derniers mois :
        $cad = array();
        for($i=1; $i<13; $i++ )
        {
            $cad[$i] = ($mois0+$i-1)%12+1;
        }        
        // On dispose donc pour chaque produit.id 
        // - d'un tableau $cadencierP[$id] sur 12 mois
        // - d'un tableau $cadencierV[$id] sur 12 mois
        // - d'un tableau $cmdesV[$id] sur 12 mois

        $Fournisseurs = $em->getRepository('AdBundle:Fournisseurs')->findAll();
        $Produits = $em->getRepository('EcomBundle:Produits')->findAllByFournisseur();

        // On transfère ces données dans l'objet $PrdReassort :
        foreach($Produits as $produit)
        {          
            $id = $produit->getId();
            $PrdReassort = new PrdReassort();
            $PrdReassort->setId($id);
            $PrdReassort->setNom($produit->getNom());
            $PrdReassort->setFournisseur($produit->getFournisseur()); 
            $PrdReassort->setCategorie($produit->getCategorie()); 
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
             return $this->redirect($this->generateUrl('adminStocks_reassort'));
        }

        return $this->render('AdBundle:Administration:Stocks/layout/reassort.html.twig', array(
            'Produits' => $Produits,'Fournisseurs'=>$Fournisseurs,'moistxt'=>$moistxt, 'cad' => $cad, 'cadencierP' => $cadencierP,'cadencierV' => $cadencierV, 'cmdesV'=> $cmdesV, 'moyVtes'=>$moyVtes, 'form'=>$form->createView()
        ));
    }

    public function reassortPDFAction()
    {
        $em = $this->getDoctrine()->getManager();
        $mois0 = (int)date('m'); // = mois en cours
        $tabMois = array('janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre');
        $moistxt = $tabMois[$mois0-1];

        $moy=array(); $nm=array();$cmdesV = array();

        // Extraction des produits :
        $Produits = $em->getRepository('EcomBundle:Produits')->findAll();

        $cadencierV = $this->cadencierMaker('0', $Produits);
        $cadencierP = $this->cadencierMaker('1', $Produits);
        foreach($Produits as $Produit)
        {   
            $id=$Produit->getId();
            $cmdesV[$id] = 0;
            $moyVtes[$id] = 0;
            for($i=1; $i<13; $i++ )
            {
                $cmdesV[$id] += $cadencierV[$id][$i];
            }
            $moyVtes[$id] =  $this->moyVtes($mois0, $cadencierV, $cadencierP, $id);
        }
        //var_dump($moyVtes); die();
        //Création du tableau des 12 derniers mois :
        $cad = array();
        for($i=1; $i<13; $i++ )
        {
            $cad[$i] = ($mois0+$i-1)%12+1;
        }        
        // On dispose donc pour chaque produit.id 
        // - d'un tableau $cadencierP[$id] sur 12 mois
        // - d'un tableau $cadencierV[$id] sur 12 mois
        // - d'un tableau $cmdesV[$id] sur 12 mois

        $Fournisseurs = $em->getRepository('AdBundle:Fournisseurs')->findAll();
        $Produits = $em->getRepository('EcomBundle:Produits')->findAllByFournisseur();
        $vendeur = $em->getRepository('AdBundle:Vendeur')->findOneById('1');

        $this->container->get('setNewReassort')->reassort($vendeur, $Produits, $Fournisseurs, $moistxt, $cad, $cadencierP, $cadencierV, $cmdesV, $moyVtes);

    }

   public function nbRupturesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $mois0 = (int)date('m'); // = mois en cours
        $moy=array(); $nm=array();$cmdesV = array();
        $Produits = $em->getRepository('EcomBundle:Produits')->findAll();
        $nbRupt = 0 ; $nbSensb = 0 ;

        $cadencierV = $this->cadencierMaker('0', $Produits);
        $cadencierP = $this->cadencierMaker('1', $Produits);
        foreach($Produits as $Produit)
        {   
            $id=$Produit->getId();
            $moyVtes[$id] = 0;
            $moyVtes[$id] =  $this->moyVtes($mois0, $cadencierV, $cadencierP, $id);
            if($Produit->getStockvirtuel() == 0) {$nbRupt ++; }
            elseif ($Produit->getStockvirtuel()<= $moyVtes[$id]) { $nbSensb++;}         
        }
        return $this->render('AdBundle:Administration:Stocks/modulesUsed/nbRuptures.html.twig', array(
            'nbRupt' => $nbRupt, 'nbSensb' => $nbSensb, 'moyVtes'=>$moyVtes
        ));
    }


    public function demqAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $Demarque = new Demarque();
       
        // Extraction des produits :
        $Produits = $em->getRepository('EcomBundle:Produits')->findAll();

        foreach($Produits as $produit)
        {          
            $id = $produit->getId();
            $PrdDemarque = new PrdDemarque();
            $PrdDemarque->setId($id);
            $PrdDemarque->setNom($produit->getNom()); 
            $PrdDemarque->setStockreel($produit->getStockreel());

            $Demarque->addPrdDemarque($PrdDemarque);
        }

        $form = $this->createForm(DemarqueType::class, $Demarque);

       $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $PrdDemarques = $Demarque->getPrdDemarque();
            foreach($PrdDemarques as $prdDemarque)
            {          
                $id = $prdDemarque->getId();            
                $Produit = $em->getRepository('EcomBundle:Produits')->find($id);
                $Produit->setStockreel($Produit->getStockreel()-$prdDemarque->getCasse()-$prdDemarque->getDefect()-$prdDemarque->getAutre());
                $Produit->setStockvirtuel($Produit->getStockvirtuel()-$prdDemarque->getCasse()-$prdDemarque->getDefect()-$prdDemarque->getAutre());
                $em->persist($Produit);
            }
            $em->flush();
             return $this->redirect($this->generateUrl('adminStocks_demarque'));
        }

        return $this->render('AdBundle:Administration:Stocks/layout/demq.html.twig', array('form'=>$form->createView()
        ));
    }

    public function inventrAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
         $session = $request->getSession();
        if (!$session->has('validprov'))
            $validprov = 0;
        else
            $validprov = $session->get('validprov');


        $Inventr = new Inventr(); $sommeStocks = 0; $nbStocks = 0;
       
        // Extraction des produits :
        $Produits = $em->getRepository('EcomBundle:Produits')->findAll();

        foreach($Produits as $produit)
        {          
            $id = $produit->getId();
            $PrdInventr = new PrdInventr();
            $PrdInventr->setId($id);
            $PrdInventr->setNom($produit->getNom()); 
            $PrdInventr->setCategorie($produit->getCategorie());
            $PrdInventr->setStockreel($produit->getStockreel());
            $sommeStocks += $produit->getStockreel();
            $nbStocks++;
            $PrdInventr->setStockinventaire($produit->getStockinventaire());
            $Inventr->addPrdInventr($PrdInventr);
        }

        $form = $this->createForm(InventrType::class, $Inventr);

       $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $PrdInventrs = $Inventr->getPrdInventr();
            $validprov = $Inventr->getValidprov();
            $session->set('validprov', $validprov);
            foreach($PrdInventrs as $prdInventr)
            {          
                $id = $prdInventr->getId();            
                $Produit = $em->getRepository('EcomBundle:Produits')->find($id);
                $Produit->setStockinventaire($prdInventr->getStockinventaire());
                $em->persist($Produit);
            }
            $em->flush();
            
             return $this->redirect($this->generateUrl('adminStocks_inventr', array('validprov' => $validprov)));
        }

        return $this->render('AdBundle:Administration:Stocks/layout/inventr.html.twig', array('validprov' => $validprov,'nbStocks'=>$nbStocks,'sommeStocks'=>$sommeStocks,'form'=>$form->createView()));
    }

    public function validInventrAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set('validprov', '0'); $validprov = 0;
        $Produits = $em->getRepository('EcomBundle:Produits')->findAll();

        foreach($Produits as $produit)
        {      
            $produit->setStockreel($produit->getStockinventaire());
            $produit->setStockinventaire(0); 
            $em->persist($produit);             
        }
        $em->flush();

        $Inventr = new Inventr(); $sommeStocks = 0; $nbStocks = 0;

        foreach($Produits as $produit)
        {          
            $id = $produit->getId();
            $PrdInventr = new PrdInventr();
            $PrdInventr->setId($id);
            $PrdInventr->setNom($produit->getNom()); 
            $PrdInventr->setCategorie($produit->getCategorie());
            $PrdInventr->setStockreel($produit->getStockreel());
            $sommeStocks += $produit->getStockreel();
            $nbStocks++;
            $PrdInventr->setStockinventaire($produit->getStockinventaire());
            $Inventr->addPrdInventr($PrdInventr);
        }

        $form = $this->createForm(InventrType::class, $Inventr);

        return $this->render('AdBundle:Administration:Stocks/layout/inventr.html.twig', array('validprov' => $validprov,'nbStocks'=>$nbStocks,'sommeStocks'=>$sommeStocks,'form'=>$form->createView()));      
    }

}