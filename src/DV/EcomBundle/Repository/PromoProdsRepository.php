<?php

namespace DV\EcomBundle\Repository;

/**
 * PromoProdsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PromoProdsRepository extends \Doctrine\ORM\EntityRepository
{
	/* Querybuilder recherche promotions en cours */
	public function findByDateFin($now)
	{ 
		$qb = $this->createQueryBuilder('prm');
		$qb ->where('prm.datefin >= :now')
			->orderBy('prm.datefin')
			->setParameter('now', $now) ;
		return $qb->getQuery()->getResult();
	}

	/* Querybuilder recherche promotion en cours d'un produit */
	/* Départ PromoProdsRepository */
	public function findPromoProd($produit)
	{ 
		$qb = $this->createQueryBuilder('prm');
		$qb ->where('prm.produit = :produit')
			->andWhere(':now <= prm.datefin')
			->andWhere(':now >= prm.datedeb')
			->orderBy('prm.datedeb', 'ASC')
			->setMaxResults(1)
			->setParameter('produit',$produit)
			->setParameter('now', new \DateTime(), \Doctrine\DBAL\Types\Type::DATETIME)
			;
		return $qb->getQuery()->getResult();
	}

	/*public function findProdPromoProdById($id)
	{   
		/* Querybuilder recherche produit et leur promo en cours */
		/* Départ ProduitsRepository */
		/*$qb = $this->createQueryBuilder('prd');
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
	}*/

	public function findAllPromoProdProd()
	{   
		/* Querybuilder recherche promos en cours et leur produit */
		/* Départ PromoProdsRepository */
		$qb = $this->createQueryBuilder('prm');
		$qb ->select('prm', 'max(prm.datedeb)')
		 	->where('prm.datefin >= :now')
			->andWhere('prm.datedeb <= :now')
			->groupBy('prm.produit')
			->setParameter('now', new \DateTime(), \Doctrine\DBAL\Types\Type::DATETIME);
		$qb = $qb
			->join('prm.produit','prd')
			->addSelect('prd')	 
			;
		return $qb->getQuery()->getResult();
	}	
}