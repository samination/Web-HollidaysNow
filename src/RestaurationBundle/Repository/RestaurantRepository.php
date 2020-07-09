<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 26/12/2018
 * Time: 16:17
 */

namespace RestaurationBundle\Repository;


use Doctrine\ORM\EntityRepository;

class RestaurantRepository extends  EntityRepository {


	public function rechercheMot($mot)
	{
		$qb = $this->getEntityManager()->createQueryBuilder();
		$qb->select(array('r'))
		   ->from('RestaurationBundle:Restaurants', 'r')
		   ->where($qb->expr()->orX(
			   $qb->expr()->like('r.nomResto', '?1')
		   ))
		   ->setParameter('1', '%'.$mot.'%');
		return $qb->getQuery()->getResult();

	}

	public function rechercheTypet($mot)
	{
		$qb = $this->getEntityManager()->createQueryBuilder();
		$qb->select(array('r'))
		   ->from('RestaurationBundle:Restaurants', 'r')
		   ->where($qb->expr()->orX(
			   $qb->expr()->like('r.specialiteResto', '?1')
		   ))
		   ->setParameter('1', '%'.$mot.'%');
		return $qb->getQuery()->getResult();

	}
}