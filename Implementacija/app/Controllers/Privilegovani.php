<?php

namespace App\Controllers;

use App\Models\Entities;

/*
 * Klasa Privilegovani - implementira metode kontrolera koji sluzi za funkcionalnosti privilegovanog korisnika
 * 
 *  @version 1.0
 */
class Privilegovani extends Korisnik
{   
    
    protected function prikaz($page, $data) {
        $data['controller'] = 'Privilegovani';
        if ($page=='Pocetna') echo view('Sablon/header_korisnik', ['controller'=>'Privilegovani']);
        else echo view('Sablon/header', ['controller'=>'Privilegovani']);
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
    }
    
    /*
     * Funkcija dodajCilj() - Dodaje licni cilj korisniku
     * @author Andrej Jokic 18-0247
     */
    function dodajCilj() {
        if ($this->request->getVar('brojKnjiga') <= 0) {
            session()->setFlashdata("poruka", "Entered number is not valid!");
            return redirect()->to(site_url("/{$this->getController()}/prikaziProfil"));
        }
      
        $user = $this->doctrine->em->getRepository(Entities\User::class)->find(session()->get("korisnik")->getIdu());
        $user->setPersonalGoal($this->request->getVar('brojKnjiga'));
        $this->doctrine->em->flush();
        
        session()->setFlashdata("poruka", "Personal goal successfully added!");
        
        return redirect()->to(site_url("/{$this->getController()}/prikaziProfil"));
    }
    /*
     * 
     * funkcija za prikaz knjige
     * Sara Kolarevic 2018/0388
     */
//     public function prikaziKnjigu($id){
//        $book=$this->doctrine->em->getRepository(Entities\Book::class)->find($id);
//        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
//        $this->prikaz('Knjiga', ['knjiga'=>$book, 'komentari' => $book->getReviews(),'korisnik' => $user,'citati' => $book->getQuotes()]);
//    }
    
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
        
        //return redirect()->to($_SERVER['HTTP_REFERER']);
    }
    
     /*
     * dodavanje citata iz knjige
     * Sara Kolarevic 2018/0388
     */
    public function addQuote($poruka=null){
        $referer=$_SERVER['HTTP_REFERER'];
        echo view("Stranice/Quote", ["poruka"=>$poruka,"referer"=>$referer,"controller"=>$this->getController()]);
        
    }
    /*
     * potvrdnjivanje dodavanja citata
     * Sara Kolarevic 2018/0388
     */
    public function registerAddQuote(){
        $user=$this->doctrine->em->getRepository(\App\Models\Entities\User::class)->find($this->session->get("korisnik")->getIdu());
        $referer=$this->request->getVar("hiddenBook");
        $text=$this->request->getVar("quote");
        $args=explode("/",$referer);
        $bookId=intval($args[count($args)-1]);
        $book=$this->doctrine->em->getRepository(\App\Models\Entities\Book::class)->find($bookId);
        $quote=new \App\Models\Entities\Quote();
          $quote->setBook($book);
          $quote->setUser($user);
          $quote->setText($text);
            // $user->addQuote($quote);
            // $book->addQuote($quote);
          $this->doctrine->em->persist($quote);      
          $this->doctrine->em->flush();
          $path="";
        for($i=3;$i<count($args);$i++)
        {   
            
            $path=$path."/".$args[$i];
        }
        session()->setFlashdata("displayNotificationMessage", "Successfully added new quote!");
         return redirect()->to(site_url($path));
        //return $this->prikaziKnjigu(intval($args[sizeof($args)-1]),"Successfully added new quote");

    }
}

