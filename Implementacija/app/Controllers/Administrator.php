<?php

namespace App\Controllers;

/*
 * Klasa Administrator - implementira metode kontrolera koji sluzi za funkcionalnosti Administratora
 * 
 *  @version 1.0
 */
class Administrator extends BaseController
{
    /*
     * Funkcija prikaz - sluzi za prikazivanje stranice sa nepromenljivim(header,footer) i promenljivim delovima ( sredisnji deo stranice koji se razlikuje
     * u zavistnosti od trenutne pozicije korisnika na sajtu)
     * 
     * @param string $page String
     * @param string[] $data String[]
     */
    protected function prikaz($page, $data) {
        $data['controller'] = 'Administrator';
        echo view('Sablon/header_administrator');
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
    }
    
     /*
     * Funkcija index - pocetna stranica za gosta
     */
    public function index() {
        $this->prikaz('Pocetna', []);
    }
    
    /*
     * Funkcija prikaziRegistracije() - sluzi za prikazivanje svih zahteva korisnika za registrovanje
     * @author Andrej Jokic 18/0247
     */
    public function prikaziRegistracije() {
        $registracije = $this->doctrine->em->getRepository('App\Models\Entities\User')->findBy(['status'=>'pending']);
        $this->prikaz('Registracije', ['registracije'=>$registracije]);
    }
   
    /*
     * Funkcija potvrdiRegistraciju() - sluzi za prihvatanje registracije korisnika, nakon cega korisnik postaje registrovan
     * @author Andrej Jokic 18/0247
     */
    public function potvrdiRegistraciju() {
//        $data['username'] = $this->request->getVar('username');
//        $data['status'] = 'registered';
//        $userModel = new UserModel();
//        $userModel->postaviStatus($data);
//        return redirect()->to(site_url('Administrator/prikaziRegistracije'));
        $user = $this->doctrine->em->getRepository('App\Models\Entities\User')->findOneBy(['username'=>$this->request->getVar('username')]);
        $user->setStatus('registered');
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Administrator/prikaziRegistracije'));
    }
    
    /*
     * Funkcija odbijRegistraciju() - sluzi za odbijanje registracije korisnika, nakon cega korisnik ostaje gost sistema
     * @author Andrej Jokic 18/0247
     */
    public function odbijRegistraciju() {
//        $userModel = new UserModel();
//        $userModel->izbrisiKorisnika($this->request->getVar('username'));
//        return redirect()->to(site_url('Administrator/prikaziRegistracije'));
        $user = $this->doctrine->em->getRepository('App\Models\Entities\User')->findOneBy(['username'=>$this->request->getVar('username')]);
        $this->doctrine->em->remove($user);
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Administrator/prikaziRegistracije'));
    }
        
}

