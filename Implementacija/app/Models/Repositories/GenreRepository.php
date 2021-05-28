<?php namespace App\Models\Repositories;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\ORM\EntityRepository;

class GenreRepository extends EntityRepository{
    
    /*
     * Funkcija dohvatiPretplaceneZanroveKorisnika() - sluzi za dohvatanje svih zanrova na koje je korisnik pretplacen
     * @author Andrej Jokic 18/0247
     */
    public function dohvatiPretplaceneZanroveKorisnika($idu) {
        $dql = "SELECT g FROM App\Models\Entities\Genre g JOIN g.users u"
                . " WHERE u.idu=:idu";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'idu'=> $idu
        ]);
        return $query->getResult();
    }
    
    /*
     * Funkcija dohvatiZanroveKorisnika() - sluzi za dohvatanje svih zanrova na koje je korisnik pretplacen
     * @author Andrej Jokic 18/0247
     */
    public function dohvatiNepretplaceneZanroveKorisnika($idu) {
        $dql = "SELECT g FROM App\Models\Entities\Genre g"
                . " WHERE g.idg NOT IN("
                . "SELECT ge.idg FROM App\Models\Entities\Genre ge JOIN ge.users u"
                . " WHERE u.idu=:idu"
                . ")";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'idu'=> $idu
        ]);
        return $query->getResult();
    }
}
