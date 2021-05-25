<?php namespace App\Models\Repositories;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Repositories;

/**
 * Description of BookRepository
 *
 * @author Nikola Krstic 18/0546
 */
class BookRepository extends \Doctrine\ORM\EntityRepository{
    
    public function dohvatiKnjigu($idb){
        $dql = "SELECT b FROM App\Models\Entities\Book b"
                . " WHERE b.idb=:idbook";;
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'idbook' => $idb
        ]);
        return $query->getResult();
    }
}
