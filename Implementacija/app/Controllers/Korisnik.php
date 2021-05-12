<?php

namespace App\Controllers;

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
}
