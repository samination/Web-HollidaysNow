<?php
/**
 * Created by PhpStorm.
 * User: Y520-I7-1TR-4G
 * Date: 30/11/2018
 * Time: 05:08
 */

namespace VoyageOrganiseBundle\Repository;


class VoyageOrganiseRepository extends \Doctrine\ORM\EntityRepository
{


    public function findByp($dest){
        $query= $this->getEntityManager()->createQuery("SELECT v FROM VoyageOrganiseBundle:Voyageorganise v WHERE v.paysDestination =:paysDestination ORDER BY  v.paysDestination DESC  ")
            ->setParameter('paysDestination', $dest);


        return $query->getResult();
    }
}