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
    /*
     * Funkcija prikaz - sluzi za prikazivanje stranice sa nepromenljivim(header,footer) i promenljivim delovima ( sredisnji deo stranice koji se razlikuje
     * u zavistnosti od trenutne pozicije korisnika na sajtu)
     * 
     * @param string $page String
     * @param string[] $data String[]
     */
    protected function prikaz($page, $data) {
        $data['controller'] = 'Korisnik';
        echo view('Sablon/header_korisnik');
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
    }
    
     /*
     * Funkcija index - pocetna stranica za gosta
     */
    public function index() {
        $this->prikaz('Pocetna', []);
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
        $this->prikaz('Profil', ['korisnik'=>$user]);
    }
}
