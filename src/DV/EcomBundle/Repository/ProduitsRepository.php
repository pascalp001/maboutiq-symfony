<?php

namespace DV\EcomBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProduitsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitsRepository extends EntityRepository
{
	public function findArray($array)
	{
		//On envoie un tableau contenant nos produits...
		$qb = $this->createQueryBuilder('u')
			->select('u')
			->where('u.id IN (:array)')
			->setParameter('array', $array);
		return $qb->getQuery()->getResult();		
	}

	public function findSelec($categorie, $tri)
	{
		// 'u' est un alias qui va représenter un produit (puisqu'on le sélectionne dans l'entité Produit)
		// :categorie va représenter la catégorie passée en paramètre c'est à dire $categorie
		$qb = $this->createQueryBuilder('p')
			->where('p.disponible = 1')
			->orderBy('p.id');
		if($categorie != null){
			$qb = $qb->andWhere('p.categorie = :categorie')
					->setParameter('categorie', $categorie);
		}									
		if($tri == 'nom_asc') 	$qb = $qb->orderBy('p.nom', 'ASC');
		if($tri == 'nom_desc')	$qb = $qb->orderBy('p.nom', 'DESC');
		if($tri == 'pop_asc')	$qb = $qb->orderBy('p.popularite', 'ASC');
		if($tri == 'pop_desc')	$qb = $qb->orderBy('p.popularite', 'DESC');
		if($tri == 'prix_asc')	$qb = $qb->orderBy('p.prix', 'ASC');
		if($tri == 'prix_desc')	$qb = $qb->orderBy('p.prix', 'DESC');
		return $qb->getQuery()->getResult();
	}

	public function recherche($chaine)
	{
		$qb = $this->createQueryBuilder('u')
			->select('u')
			->where('u.nom like :chaine')
			->andWhere('u.disponible = 1') 
			->orderBy('u.id')
			->setParameter('chaine', $chaine);
		return $qb->getQuery()->getResult();
	}

	public function preferred_tva($tva)
	{
		$qb = $this->createQueryBuilder('t')
			->select('t')
			->where('t.nom = :tva')
			->setParameter('tva', $tva);
		return $qb->getQuery()->getResult();		
	}

	public function findProdPromoProdById($id)
	{   
		/* Querybuilder recherche produit et leur promo en cours */
		/* Départ ProduitsRepository */
		$qb = $this->createQueryBuilder('prd');
		$qb ->where('p.id = :id')
			->join('prd.promoProd','prm')
			->addSelect('prm')
			->andWhere('prm.datefin >= :now')
			->andWhere('prm.datedeb <= :now')
			->orderBy('prm.datedeb', 'ASC')
			->setMaxResults(1)
			->setParameter(':id',$id)
			->setParameter('now', new \DateTime(), \Doctrine\DBAL\Types\Type::DATETIME) 
			;
		return $qb->getQuery()->getResult();
	}

	public function findAllProdPromoProdSelec($categorie, $tri)
	{   
		/* Querybuilder recherche produits et leur promo en cours */
		/* Départ ProduitsRepository */
		$subqb = $this->createQueryBuilder('p')	
			->where( ':now BETWEEN p.datedeb AND p.datefin')
			->setParameter('now', new \DateTime(), \Doctrine\DBAL\Types\Type::DATETIME)
			->orderBy('p.datedeb', 'ASC')
			->setMaxResults(1);

		$qb = $this->createQueryBuilder('prd')
			->leftjoin('prd.promoProd','prm', 'WITH')
			->addSelect('prm');

		$qb = $qb
			->andWhere($qb->expr()->in('prd.promoProd', $subqb->getDQL()));
		
		$qb = $qb
			->where('prd.disponible = 1')
			->orderBy('prd.id');
		if($categorie != null){
			$qb = $qb->andWhere('prd.categorie = :categorie')
					->setParameter('categorie', $categorie);
		}
									
		if($tri == 'nom_asc') 	$qb = $qb->orderBy('prd.nom', 'ASC');
		if($tri == 'nom_desc')	$qb = $qb->orderBy('prd.nom', 'DESC');
		if($tri == 'pop_asc')	$qb = $qb->orderBy('prd.popularite', 'ASC');
		if($tri == 'pop_desc')	$qb = $qb->orderBy('prd.popularite', 'DESC');
		if($tri == 'prix_asc')	$qb = $qb->orderBy('prd.prix', 'ASC');
		if($tri == 'prix_desc')	$qb = $qb->orderBy('prd.prix', 'DESC');
		return $qb->getQuery()->getResult();
	}	
}
