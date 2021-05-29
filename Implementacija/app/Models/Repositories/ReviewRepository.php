<?php namespace App\Models\Repositories;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\ORM\EntityRepository;

class ReviewRepository extends EntityRepository{
    
    /*
     * Funkcija dohvatiPretplaceneZanroveKorisnika() - sluzi za dohvatanje svih zanrova na koje je korisnik pretplacen
     * @author Andrej Jokic 18/0247
     */
//    public function dohvatiPretplaceneZanroveKorisnika($idu) {
//        $dql = "SELECT g FROM App\Models\Entities\Genre g JOIN g.users u"
//                . " WHERE u.idu=:idu";
//        $query = $this->getEntityManager()->createQuery($dql);
//        $query->setParameters([
//            'idu'=> $idu
//        ]);
//        return $query->getResult();
//    }
//    
    public function getReviewsFromAccountType($bookId,$type){
        $dql="SELECT r FROM App\Models\Entities\Review r JOIN r.user u Join r.book b WHERE u.type=:type and b.idb=:bookId";
        $query=$this->getEntityManager()->createQuery($dql);
        $query->setParameter("type", $type);
        $query->setParameter("bookId", $bookId);
        return $query->getResult();
        
    }
    
    public function getReviewsFromNotAccountType($bookId,$type){
        $dql="SELECT r FROM App\Models\Entities\Review r JOIN r.user u Join r.book b WHERE u.type!=:type and b.idb=:bookId";
        $query=$this->getEntityManager()->createQuery($dql);
        $query->setParameter("type", $type);
        $query->setParameter("bookId", $bookId);
        return $query->getResult();
    }
    
}
