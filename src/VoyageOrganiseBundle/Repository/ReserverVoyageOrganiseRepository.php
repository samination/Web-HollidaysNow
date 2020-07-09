<?php
/**
 * Created by PhpStorm.
 * User: Y520-I7-1TR-4G
 * Date: 30/11/2018
 * Time: 17:51
 */

namespace VoyageOrganiseBundle\Repository;


class ReserverVoyageOrganiseRepository extends \Doctrine\ORM\EntityRepository
{
    public function findSignal($idVoyageorganise)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select s from VoyageOrganiseBundle:Voyageorganise s WHERE s.id=:idVoyageorganise
            ")
            ->setParameter('idVoyageorganise', $idVoyageorganise);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findNbSignal($idVoyageorganise){
        $query = $this->getEntityManager()
            ->createQuery(
                "selectVoyageOrganiseBundle:Voyageorganise s WHERE s.id=:idVoyageorganise
            ")
            ->setParameter('idVoyageorganise',$idVoyageorganise);

        return $query->getSingleResult();

    }
}