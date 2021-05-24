<?php namespace App\Models\Repositories;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vestRepository
 *
 * @author Nikola Krstic 18/0546
 */

use Doctrine\ORM\EntityRepository;
class UserbooksRepository extends EntityRepository{
    
    public function dohvatiProcitane($idu){//type=read
        $dql = "SELECT u FROM App\Models\Entities\Userbooks u "
                . " WHERE u.type=:tipKnjige AND u.idu=:iduser";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'tipKnjige' => 'read',
            'iduser' => $idu
        ]);
        return $query->getResult();
    }
    
    public function dohvatiWantToRead($idu){//type=want-to-read
        $dql = "SELECT u FROM App\Models\Entities\Userbooks u "
                . " WHERE u.type=:tipKnjige AND u.idu=:iduser";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'tipKnjige' => 'want-to-read',
            'iduser' => $idu
        ]);
        return $query->getResult();
    }
    
    public function dohvatiSve($idu){
        $dql = "SELECT u FROM App\Models\Entities\Userbooks u "
                . " WHERE u.idu=:iduser";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'iduser' => $idu
        ]);
        return $query->getResult();
    }
    
}
