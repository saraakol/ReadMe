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
    
    protected function prikaz($page, $data) {
        $data['controller'] = 'Privilegovani';
        $data['user_type'] = session()->get("korisnik")->getType();
        
        echo view('Sablon/header_korisnik');
        echo view("Stranice/$page", $data);
        echo view('Sablon/footer');
    }
    public function index() {
        $books = $this->doctrine->em->getRepository(Entities\Book::class)->findAll();
        $genres=$this->doctrine->em->getRepository(Entities\Genre::class)->findAll();
        $this->prikaz('Pocetna', ['knjige' => $books,'genres' => $genres]);
    }
    /*
     * komentarisanje knjige
     * Andrej Veselinovic 2018/0221
     */
    public function addReview($poruka=null){
        $referer=$_SERVER['HTTP_REFERER'];
        echo view("Stranice/Review", ["poruka"=>$poruka,"referer"=>$referer,"controller"=>"korisnik"]);
        
    }
    /*
     * Funkcija dodajCilj() - Dodaje licni cilj korisniku
     * @author Andrej Jokic 18-0247
     */
    function dodajCilj() {
        if ($this->request->getVar('brojKnjiga') <= 0) {
            return redirect()->to(site_url('Korisnik/prikaziProfil'));
        }
      
        $user = $this->doctrine->em->getRepository(Entities\User::class)->find(session()->get("korisnik")->getIdu());
        $user->setPersonalGoal($this->request->getVar('brojKnjiga'));
        $this->doctrine->em->flush();
        return redirect()->to(site_url('Korisnik/prikaziProfil'));
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
     * 
     * funkcija za prikaz knjige
     * Sara Kolarevic 2018/0388
     */

     public function prikaziKnjigu($id){
         
        $book=$this->doctrine->em->getRepository(Entities\Book::class)->find($id);
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $reviews=[];
        $moreReviews=$this->doctrine->em->getRepository(Entities\Review::class)->getReviewsFromAccountType("privileged_user");
//        echo sizeof($moreReviews);
        $reviews=array_merge($reviews,$moreReviews);
        $reviews=array_merge($reviews,$this->doctrine->em->getRepository(Entities\Review::class)->getReviewsFromNotAccountType("privileged_user"));
        $this->prikaz('Knjiga', ['knjiga'=>$book, 'komentari' => $reviews,'korisnik' => $user,'citati' => $book->getQuotes()]);
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
    
    /*
     * funkcija za filtriranje
     * Nikola Krstic 18/0546
     */
    
    public function filter(){
        //$knjige = $this->session->get("knjige");//pocetni niz knjiga
        $knjige = $this->doctrine->em->getRepository(Entities\Book::class)->findAll();
        $genres=$this->doctrine->em->getRepository(Entities\Genre::class)->findAll();

        if(isset($_POST['submit']))
            $selected = $_POST['filter']; 


        $noveKnjige = [];
        foreach($knjige as $knjiga){

            $bookGenres = $knjiga->getGenres();
            foreach($bookGenres as $genre){
                if($genre->getName()== $selected)
                    $noveKnjige[] = $knjiga;
            }
        }
        $this->prikaz('Pocetna', ['noveKnjige' => $noveKnjige,'knjige' => $knjige, 'genres' => $genres]);  
    }
    
    /*
     * funkcija za sortiranje
     * Nikola Krstic 18/0546
     */
    
    public function sort(){
        //$knjige = $this->session->get("knjige");//pocetni niz knjiga
        $knjige = $this->doctrine->em->getRepository(Entities\Book::class)->findAll();
        $genres=$this->doctrine->em->getRepository(Entities\Genre::class)->findAll();
         
        if(isset($_POST['submit']))
            $selected = $_POST['sort'];
        
        
        switch ($selected){
            case "A-Z":
                usort($knjige, function($a, $b){
                    return strcmp($a->getName(), $b->getName());
                });
                break;
            case "Z-A":
                usort($knjige, function($a, $b){
                    return strcmp($b->getName(),$a->getName());
                });
                break;
        }
        
        $this->prikaz('Pocetna', ['knjige' => $knjige,'genres' => $genres]);
    }
    
    /*
     * Funkicja za dodavanje na Want to read listu
     * @author Nikola Krstic 18/0546
     */

    public function dodajNaWantListu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $book = $this->doctrine->em->getRepository(Entities\Book::class)->findOneBy(["idb" => $this->request->getVar('idb')]);
        $userBookk = $this->doctrine->em->getRepository(Entities\Userbooks::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu(),"idb" => $book->getIdb()]);
        if($userBookk==null){
            //$user->setUsername("nikolakrstic");//nikolakrstic
            //$book->setName("Harry Potter and the Philosopher's stone");//Harry Potter and the Philosopher's stone


            $userbook = new Entities\Userbooks();

            $userbook->setType("want-to-read");
            $userbook->setIdb($book);
            $userbook->setIdu($user);


            $user->addBook($userbook); //ovde je greska
            $this->doctrine->em->persist($userbook);
            $this->doctrine->em->persist($user);
            $this->doctrine->em->persist($book);
            $this->doctrine->em->flush();
        }
        $this->prikaz('Knjiga', ['knjiga' => $book]);
    }
    
    /*
     * Funkcija za dodavanje na All listu
     * Nikola Krstic 18/0546
     */

    public function dodajNaReadListu() {
        $user = $this->doctrine->em->getRepository(Entities\User::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu()]);
        $book = $this->doctrine->em->getRepository(Entities\Book::class)->findOneBy(["idb" => $this->request->getVar('idb')]);
        $userBookk = $this->doctrine->em->getRepository(Entities\Userbooks::class)->findOneBy(["idu" => session()->get("korisnik")->getIdu(),"idb" => $book->getIdb()]);
        
        if($userBookk!=null){
            if($userBookk->getType()=="read"){//ukoliko postoji na read listi
                return $this->prikaz('Knjiga', ['knjiga' => $book]);
            }else{//ukoliko postoji na write listi treba je izbaciti sa te liste
                $this->doctrine->em->remove($userBookk);
            }
        }
        
            #foreach($user->getBooks() as $userbooktmp){
               # if($userbooktmp->getIdb()->getIdb()==$book->getIdb()){
                #    if($userbooktmp->getType()=="want-to-read"){
                 #       $this->doctrine->em->remove($userbooktmp);
                  #  }
                #}
            #}
        $userbook = new Entities\Userbooks();
        $userbook->setType("read");
        $userbook->setIdb($book);
        $userbook->setIdu($user);


        $user->addBook($userbook);//ovde je greska
        $this->doctrine->em->persist($userbook);
        $this->doctrine->em->persist($user);
        $this->doctrine->em->persist($book);
        $this->doctrine->em->flush();
        
        return $this->prikaz('Knjiga', ['knjiga' => $book]);
    }
}

