<?php namespace App\Models\Repositories;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vestRepository
 *
 * @author andrej
 */

use Doctrine\ORM\EntityRepository;
use \Doctrine\Common\Collections\Criteria;
class UserRepository extends EntityRepository{
    
    /*
     * Funkcija dohvatiKandidateZaUnapredjenje() - sluzi za dohvatanje svih korisnika koji su procitali vise od 100 knjiga i kandidati su za unapredjenje
     * @author Andrej Jokic 18/0247
     */
    public function dohvatiKandidateZaUnapredjenje() {
        $dql = "SELECT u FROM App\Models\Entities\User u JOIN u.books b"
                . " WHERE u.type=:tipKorisnika AND u.status=:statusKorisnika AND b.type=:tipKnjige"
                . " GROUP BY u.idu"
                . " HAVING COUNT(b.idb) > :brojKnjiga";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'tipKorisnika' => 'regular_user',
            'statusKorisnika' => 'registered',
            'tipKnjige' => 'read',
            'brojKnjiga' => 1
        ]);
        return $query->getResult();
    }
}
