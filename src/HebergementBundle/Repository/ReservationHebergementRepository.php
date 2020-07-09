<?php
/**
 * Created by PhpStorm.
 * User: Y520-I7-1TR-4G
 * Date: 28/11/2018
 * Time: 04:02
 */

namespace HebergementBundle\Repository;


class ReservationHebergementRepository extends \Doctrine\ORM\EntityRepository
{
    public function findSignal($idhebergement)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select s from HebergementBundle:Hebergement s WHERE s.idhebergement=:idhebergement 
            ")
            ->setParameter('idhebergement', $idhebergement);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findNbSignal($idhebergement){
        $query = $this->getEntityManager()
            ->createQuery(
                "select s.nbSignal from HebergementBundle:Hebergement s  WHERE s.idhebergement=:idhebergement
            ")
            ->setParameter('idhebergement',$idhebergement);

        return $query->getSingleResult();

    }
}