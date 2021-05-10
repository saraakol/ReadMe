<?php

namespace App\Controllers;

/*
 * Klasa Gost - implementira metode kontrolera koji sluzi za funkcionalnosti Gosta 
 * 
 *  @version 1.0
 */
class Gost extends BaseController
{
    protected function prikaz($page, $data) {
        echo view('Sablon/header_gost');
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
    }
    
    public function index() {
        //prikaz();
    }
}
