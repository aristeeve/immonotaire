<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Repository;

use ImmoNotaire\ImmoAnnonceBundle\Entity\Regions;

/**
 * VillesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VillesRepository extends \Doctrine\ORM\EntityRepository {

//    public function ville($region) {
//
//        $query = $this->createQueryBuilder('v');
//
//        $query->where('v.regions=:region')
//                ->orderBy('v.nom', 'ASC')
//                ->setParameter('region', $region);
//        
//        
//        return $query ->getQuery()
//                        ->getResult();
//    }

}
