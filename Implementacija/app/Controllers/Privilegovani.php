<?php

namespace App\Controllers;

use App\Models\Entities;

/*
 * Klasa Privilegovani - implementira metode kontrolera koji sluzi za funkcionalnosti privilegovanog korisnika
 * 
 *  @version 1.0
 */
class Privilegovani extends BaseController
{   
    /*
     * Funkcija dodajCilj() - Dodaje licni cilj korisniku
     * @author Andrej Jokic 18-0247
     */
    function dodajCilj() {
        if ($this->request->getVar('brojKnjiga') <= 0) {
            return redirect()->to(site_url('Korisnik/prikaziProfil'));
        }
      
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["username"=>$this->request->getVar('username')]);
        $user->setPersonalGoal($this->request->getVar('brojKnjiga'));
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Korisnik/prikaziProfil'));
    }
    /*
     * 
     * funkcija za prikaz knjige
     * Sara Kolarevic 2018/0388
     */
    public function prikaziKnjigu($id){
        $book=$this->doctrine->em->getRepository(Entities\Book::class)->find($id);
        $this->prikaz('Knjiga', ['knjiga'=>$book, 'komentari' => $book->getReviews()]);
    }
    
    /*
     * Funkcija prijaviKorisnika() - Prijava korisnika se belezi u bazi podataka
     * @author Andrej Jokic 18/0247
     */
    public function prijaviKorisnika($id) {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->find($id);
        if ($user->getType() != 'administrator') {
            $user->setStatus('reported');
            $this->doctrine->em->flush();   
        }
        
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }
}

