<?php

namespace App\Controllers;

use App\Models\Entities;

/*
 * Klasa Korisnik - implementira metode kontrolera koji sluzi za funkcionalnosti Korisnika(privilegovanog i registrovanog)
 * 
 *  @version 1.0
 */
class Korisnik extends BaseController
{   
    
     protected function prikaz($page, $data) {
        $data['controller'] = 'Korisnik';
        echo view('Sablon/header_korisnik');
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
    }
     /*
     * 
     * funkcija za prikaz pocetne stranice
     * Sara Kolarevic 2018/0388
     */
    public function index() {
        $books = $this->doctrine->em->getRepository(Entities\Book::class)->findAll();
         $this->prikaz('Pocetna', ['knjige'=>$books]);
    }
    
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url("/"));
    }
    
    /*
     * Funkcija dodajPretplatu() - Sluzi za dodavanje pretplate korisnika na odredjeni zanr
     * @author Andrej Jokic 18/0247
     */
    function dodajPretplatu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu"=>$this->request->getVar('idU')]);
        $selected = $this->request->getVar('list'); //Id zanra
        $genre = $this->doctrine->em->getRepository(Entities\Genre::class)->findOneBy(['idg'=>$selected]);
        
        $user->addGenre($genre);     //Owner strana asocijacije
        
        $this->doctrine->em->flush();
        
        return redirect()->to(site_url('Korisnik/prikaziProfil'));
    }
    
    /*
     * Funkcija ukloniPretplatu() - Sluzi za uklanjanje pretplate korisnika na odredjeni zanr
     * @author Andrej Jokic 18/0247
     */
    function ukloniPretplatu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu"=>$this->request->getVar('idU')]);
        $selected = $this->request->getVar('list'); //Id zanra
        $genre = $this->doctrine->em->getRepository(Entities\Genre::class)->findOneBy(['idg'=>$selected]);
        
        $user->removeGenre($genre);     //Owner strana asocijacije
        
        $this->doctrine->em->flush();
        
        return redirect()->to(site_url('Korisnik/prikaziProfil'));
    }
    
    /*
     * Funkcija prikaziProfil() - Prikazuje p rofil korisnika
     * @author Andrej Jokic 18/0247
     */
    public function prikaziProfil() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu"=>session()->get("korisnik")->getIdu()]);
        //$all = $this->doctrine->em->getRepository(Entities\Userbooks::class)->findBy(array('idu'=>$user.getIdU()));//???
        $all =          $this->doctrine->em->getRepository(Entities\Userbooks::class)->dohvatiSve($user->getIdu());
        $read =         $this->doctrine->em->getRepository(Entities\Userbooks::class)->dohvatiProcitane($user->getIdu());
        $wantToRead =   $this->doctrine->em->getRepository(Entities\Userbooks::class)->dohvatiWantToRead($user->getIdu());
        
        $this->prikaz('Profil', ['korisnik'=>$user,'all'=>$all,'read'=>$read,'wantToRead'=>$wantToRead]);
    }
    /*
     * 
     * funkcija za prikaz knjige
     * Sara Kolarevic 2018/0388
     */
    public function prikaziKnjigu($id){
        $book=$this->doctrine->em->getRepository(Entities\Book::class)->find($id);
        $this->prikaz('Knjiga', ['knjiga'=>$book]);
    }
    
}
