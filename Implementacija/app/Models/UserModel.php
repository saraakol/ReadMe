<?php

namespace App\Models;

use CodeIgniter\Model;

/*
 * Klasa UserModel - sluzi za dohvatanje podataka iz tabele User baze podataka 
 */
class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'IdU';
    protected $returnType     = 'object';
    protected $allowedFields = ['Username', 'Password', 'FirstName', 'LastName', 'Email', 'Image', 'Type', 'Status', 'PersonalGoal'];
    
    /*
     * Funkcija dohvatiRegistracije() - dohvata sve korisnike koji su uputili zahtev za registraciju
     * 
     * @param string $page
     * @param type $data
     * 
     * @author Andrej Jokic 18/0247
     */
    public function dohvatiRegistracije() {
        return $this->where('Status', 'pending')->findAll();
    }
}

