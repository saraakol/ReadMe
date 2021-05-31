<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Repositories;

/**
 * Description of RateRepository
 *
 * @author Nikola
 */
class RateRepository extends EntityRepository{
    
    public function dohvatiOcenu($idu,$idb){//type=want-to-read
        $dql = "SELECT r FROM App\Models\Entities\Rate r "
                . " WHERE r.idb=:idknjige AND r.idu=:iduser";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'idknjige' => $idb,
            'iduser' => $idu
        ]);
        return $query->getResult();
    }
}
