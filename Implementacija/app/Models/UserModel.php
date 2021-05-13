<?php

namespace App\Models;

use CodeIgniter\Model;

/*
 * Klasa UserModel - sluzi za dohvatanje podataka iz tabele User baze podataka 
 * @version 1.0
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
     * @author Andrej Jokic 18/0247
     */
    public function dohvatiRegistracije() {
        return $this->where('Status', 'pending')->findAll();
    }
    
    /*
     * Funkcija postaviStatus() - postavlja status korisniku
     * 
     * @author Andrej Jokic 18/0247
     */
    public function postaviStatus($data) {
        $builder = $this->db->table("user");
        $builder->set('Status', $data['status']);
        $builder->where('Username', $data['username']);
        return $builder->update();
    }
    
    /*
     * Funkcija izbrisiKorisnika - brise korisnika iz sistema
     * 
     * @author Andrej Jokic 18/0247
     */
    public function izbrisiKorisnika($username) {
        $this->where('Username', $username)->delete();
    }
}

